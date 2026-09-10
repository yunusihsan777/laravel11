<?php

namespace App\Http\Controllers\Lke;

use App\Http\Controllers\Controller;
use App\Models\LkeBuktidukung;
use App\Models\LkeKomponen;
use App\Models\LkeKriteria;
use App\Models\LkeParameter;
use App\Models\LkePenilaianSatker;
use App\Models\LkeSatkerBukti;
use App\Models\LkeSubkomponen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LkeEvaluasiController extends Controller
{
    /**
     * Get current authenticated user record from sinori_login.
     */
    protected function getCurrentUser()
    {
        $satker = session('id_satker');
        if (!$satker) {
            return null;
        }
        $padded = is_numeric($satker) ? str_pad($satker, 6, '0', STR_PAD_LEFT) : $satker;
        return DB::table('sinori_login')
            ->where('id_satker', $satker)
            ->orWhere('id_satker', $padded)
            ->first();
    }

    /**
     * Determine evaluator type:
     * - 'admin': Can inspect and evaluate all satkers.
     * - 'kejati': Only inspects/evaluates Kejari (level 3) & Cabjari (level 4) under their region (id_kejati).
     * - 'kejagung': Only inspects/evaluates Kejati (level 2) & fellow Eselon 1 (level 1).
     * - 'unauthorized': Blocked from evaluation.
     */
    protected function getEvaluatorType()
    {
        $satker = session('id_satker');
        $level = session('id_sakip_level');
        $currentUser = $this->getCurrentUser();
        $nama = strtolower($currentUser ? $currentUser->satkernama : session('satkernama', ''));

        // 1. Admin
        if (in_array($satker, ['admin', '999999']) || $level == '99' || $level == 99 || str_contains((string)$satker, 'admin')) {
            return 'admin';
        }

        // 2. Kejati & WAS Kejati
        $isKejatiLevel = ($level == '2' || $level == 2);
        $isWasKejati = (
            str_starts_with(strtolower((string)$satker), 'was') ||
            str_contains(strtolower((string)$satker), 'was') ||
            str_contains($nama, 'pengawasan')
        ) && (
            str_contains($nama, 'kejati') ||
            ($currentUser && $currentUser->id_kejati > 0 && $currentUser->id_kejati < 50 && !in_array($level, ['1', 1]))
        );

        if ($isKejatiLevel || $isWasKejati) {
            return 'kejati';
        }

        // 3. Kejagung & WAS Kejagung (Eselon 1 / Pusat)
        $isKejagungLevel = ($level == '1' || $level == 1);
        $isWasPusat = in_array($satker, ['888881', '888882', 'Pengawasan', 'Panev'])
            || ($currentUser && in_array($currentUser->id_kejati, [0, 88, 92]))
            || str_contains($nama, 'jam_')
            || str_contains($nama, 'badan_');

        if ($isKejagungLevel || $isWasPusat) {
            return 'kejagung';
        }

        return 'unauthorized';
    }

    /**
     * Check if user is authorized to evaluate.
     */
    protected function checkEvaluator()
    {
        $type = $this->getEvaluatorType();

        if ($type === 'unauthorized') {
            abort(403, 'Akses Ditolak: Anda tidak memiliki wewenang untuk melakukan evaluasi / penilaian LKE.');
        }
    }

    /**
     * Check if a specific target satker is authorized to be evaluated by current user.
     */
    protected function isAuthorizedSatkerForEvaluator($targetSatkerId)
    {
        $type = $this->getEvaluatorType();

        if ($type === 'admin') {
            return true;
        }

        $paddedTarget = is_numeric($targetSatkerId) ? str_pad($targetSatkerId, 6, '0', STR_PAD_LEFT) : $targetSatkerId;
        $target = DB::table('sinori_login')
            ->where('id_satker', $targetSatkerId)
            ->orWhere('id_satker', $paddedTarget)
            ->first();
        if (!$target) {
            return false;
        }

        if ($type === 'kejati') {
            $currentUser = $this->getCurrentUser();
            $myKejati = $currentUser ? $currentUser->id_kejati : 0;
            // Kejati hanya dapat memeriksa/menilai Kejari (level 3) dan Cabjari (level 4) di bawah wilayahnya
            return $target->id_kejati == $myKejati && in_array((string)$target->id_sakip_level, ['3', '4']);
        }

        if ($type === 'kejagung') {
            // Kejagung hanya dapat memeriksa Kejati (level 2) dan sesama Eselon 1 (level 1)
            return in_array((string)$target->id_sakip_level, ['1', '2']);
        }

        return false;
    }

    /**
     * Main evaluation page.
     */
    public function index(Request $request)
    {
        $this->checkEvaluator();

        $tahun = $request->get('tahun', session('tahun_terpilih') ?? 2025);
        $evaluatorType = $this->getEvaluatorType();
        $currentUser = $this->getCurrentUser();

        // Query Satker yang dapat dievaluasi sesuai peran & wilayah wewenang
        $query = DB::table('sinori_login')
            ->whereNotIn('id_satker', ['admin', '999999', '888881', '888882', 'Pengawasan', 'Panev'])
            ->where('id_satker', 'not like', 'was%');

        if ($evaluatorType === 'kejati') {
            // Kejati & WAS Kejati hanya dapat memeriksa Kejari dan Cabjari di bawah wilayahnya
            $myKejati = $currentUser ? $currentUser->id_kejati : 0;
            $query->where('id_kejati', $myKejati)
                  ->whereIn('id_sakip_level', ['3', '4']);
        } elseif ($evaluatorType === 'kejagung') {
            // Kejagung hanya dapat memeriksa Kejati dan sesama Eselon 1
            $query->whereIn('id_sakip_level', ['1', '2']);
        }
        // Admin dapat memeriksa semua satker

        $satkerList = $query->select('id_satker', 'satkernama', 'id_sakip_level', 'id_kejati')
            ->orderBy('satkernama')
            ->get();

        // Validasi Satker terpilih
        $selectedSatker = $request->get('id_satker');
        $allowedIds = $satkerList->pluck('id_satker')->map(fn($id) => (string)$id)->toArray();

        if ($selectedSatker && !in_array((string)$selectedSatker, $allowedIds)) {
            $selectedSatker = null;
        }

        if (!$selectedSatker && $satkerList->isNotEmpty()) {
            $selectedSatker = $satkerList->first()->id_satker;
        }

        $satkerInfo = null;
        if ($selectedSatker) {
            $satkerInfo = DB::table('sinori_login')->where('id_satker', $selectedSatker)->first();
        }

        // Fetch Komponen with Subkomponen and Kriteria
        $komponenList = LkeKomponen::where('tahun', $tahun)
            ->orWhere('tahun', 2025)
            ->orderBy('id')
            ->get();

        // Fetch existing evaluations for this satker and tahun
        $existingPenilaian = [];
        if ($selectedSatker) {
            $existingPenilaian = LkePenilaianSatker::where('id_satker', $selectedSatker)
                ->where('tahun', $tahun)
                ->get()
                ->keyBy('kriteria_id');
        }

        // Fetch uploaded evidence files for this satker
        $satkerBukti = [];
        if ($selectedSatker) {
            $satkerBukti = LkeSatkerBukti::where('id_satker', $selectedSatker)
                ->orderBy('id', 'desc')
                ->get()
                ->groupBy('kriteria_id');
        }

        // Master buktidukung map
        $masterBukti = LkeBuktidukung::pluck('dokumen', 'id');

        // Calculate scores hierarchically
        $scores = $this->calculateHierarchyScores($selectedSatker, $tahun);

        return view('lke.evaluasi.index', compact(
            'satkerList',
            'selectedSatker',
            'satkerInfo',
            'tahun',
            'komponenList',
            'existingPenilaian',
            'satkerBukti',
            'masterBukti',
            'scores'
        ));
    }

    /**
     * AJAX endpoint to save evaluation for a criteria and recalculate scores.
     */
    public function saveScore(Request $request)
    {
        $this->checkEvaluator();

        $request->validate([
            'id_satker'     => 'required|string',
            'tahun'         => 'required|integer',
            'kriteria_id'   => 'required|string',
            'parameter_id'  => 'required|integer|exists:lke_parameter,id',
            'catatan'       => 'nullable|string',
        ]);

        $idSatker = $request->id_satker;

        // Validasi otoritas wilayah / jenjang evaluator terhadap Satker yang dinilai
        if (!$this->isAuthorizedSatkerForEvaluator($idSatker)) {
            return response()->json([
                'success' => false,
                'message' => 'Akses Ditolak: Anda tidak memiliki wewenang untuk menilai Satuan Kerja ini.',
            ], 403);
        }

        $tahun = $request->tahun;
        $kriteriaId = $request->kriteria_id;
        $parameterId = $request->parameter_id;
        $catatan = $request->catatan;

        // Fetch parameter details
        $param = LkeParameter::findOrFail($parameterId);
        $kriteria = LkeKriteria::where('kode', $kriteriaId)->first();

        $subkomponenId = $kriteria ? $kriteria->subkomponen_id : null;
        $komponenId = null;
        if ($subkomponenId) {
            $sub = LkeSubkomponen::where('kode', $subkomponenId)->first();
            $komponenId = $sub ? $sub->komponen_id : null;
        }

        // Save or update evaluation
        $penilaian = LkePenilaianSatker::updateOrCreate(
            [
                'id_satker'   => $idSatker,
                'tahun'       => $tahun,
                'kriteria_id' => $kriteriaId,
            ],
            [
                'komponen_id'    => $komponenId,
                'subkomponen_id' => $subkomponenId,
                'parameter_id'   => $param->id,
                'nilai'          => $param->nilai,
                'skor'           => $param->skor,
                'catatan'        => $catatan,
                'evaluator_id'   => session('id_satker') ?? 'admin',
            ]
        );

        // Recalculate totals
        $scores = $this->calculateHierarchyScores($idSatker, $tahun);

        return response()->json([
            'success'     => true,
            'message'     => "Nilai untuk Kriteria {$kriteriaId} berhasil disimpan!",
            'penilaian'   => $penilaian,
            'scores'      => $scores,
        ]);
    }

    /**
     * Calculate bottom-up hierarchical scores:
     * Kriteria -> Subkomponen -> Komponen -> Grand Total
     */
    public function calculateHierarchyScores($idSatker, $tahun)
    {
        if (!$idSatker) {
            return [
                'grand_total'   => 0,
                'komponen'      => [],
                'subkomponen'   => [],
                'evaluated_cnt' => 0,
                'total_cnt'     => 0,
            ];
        }

        // Fetch all evaluations for this satker
        $evals = LkePenilaianSatker::where('id_satker', $idSatker)
            ->where('tahun', $tahun)
            ->get();

        $evalMap = $evals->keyBy('kriteria_id');

        $komponenList = LkeKomponen::where('tahun', $tahun)->orWhere('tahun', 2025)->orderBy('id')->get();
        $subkomponenList = LkeSubkomponen::where('tahun', $tahun)->orWhere('tahun', 2025)->orderBy('id')->get();
        $allKriteria = LkeKriteria::where('tahun', $tahun)->orWhere('tahun', 2025)->orderBy('id')->get();

        $subkomponenScores = [];
        $komponenScores = [];
        $grandTotal = 0;

        // Group kriteria by subkomponen_id
        $kriteriaBySub = $allKriteria->groupBy('subkomponen_id');

        foreach ($subkomponenList as $sub) {
            $crits = $kriteriaBySub->get($sub->kode, collect());
            $subScore = 0;
            $subMax = 0;
            $subEvaluated = 0;

            foreach ($crits as $cr) {
                // Potential max score for this criteria
                $pMax = LkeParameter::where('kriteria_id', $cr->kode)->max('skor') ?? 1;
                $subMax += $pMax;

                if (isset($evalMap[$cr->kode])) {
                    $subScore += $evalMap[$cr->kode]->skor;
                    $subEvaluated++;
                }
            }

            $subkomponenScores[$sub->kode] = [
                'nama'          => $sub->nama,
                'komponen_id'   => $sub->komponen_id,
                'skor'          => round($subScore, 2),
                'max_skor'      => round($subMax, 2),
                'persentase'    => $subMax > 0 ? round(($subScore / $subMax) * 100, 1) : 0,
                'evaluated_cnt' => $subEvaluated,
                'total_cnt'     => $crits->count(),
            ];
        }

        // Aggregate to Komponen level
        foreach ($komponenList as $komp) {
            $kScore = 0;
            $kMax = 0;
            $kEvaluated = 0;
            $kTotal = 0;

            foreach ($subkomponenScores as $subKode => $subData) {
                if ($subData['komponen_id'] == $komp->id) {
                    $kScore += $subData['skor'];
                    $kMax += $subData['max_skor'];
                    $kEvaluated += $subData['evaluated_cnt'];
                    $kTotal += $subData['total_cnt'];
                }
            }

            $komponenScores[$komp->id] = [
                'nama'          => $komp->nama,
                'skor'          => round($kScore, 2),
                'max_skor'      => round($kMax, 2),
                'persentase'    => $kMax > 0 ? round(($kScore / $kMax) * 100, 1) : 0,
                'evaluated_cnt' => $kEvaluated,
                'total_cnt'     => $kTotal,
            ];

            $grandTotal += $kScore;
        }

        return [
            'grand_total'   => round($grandTotal, 2),
            'komponen'      => $komponenScores,
            'subkomponen'   => $subkomponenScores,
            'evaluated_cnt' => $evals->count(),
            'total_cnt'     => $allKriteria->count(),
        ];
    }
}
