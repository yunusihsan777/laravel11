<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Kertas Kerja 3.1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            padding: 40px 20px;
        }

        .main-wrapper {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Menyeragamkan padding semua card */
        .dashboard-card {
            background: #fff;
            padding: 20px 25px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        /* Memastikan filter-bar memiliki padding yang sama dengan card lain */
        .filter-bar {
            background: #fff;
            padding: 20px 25px;
            /* Disesuaikan agar sama dengan header-bar */
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            /* Jarak konsisten antara input dan select */
        }

        .table-container {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .table thead {
            background-color: #34495e;
            color: #fff;
        }

        .table tbody tr {
            border-bottom: 1px solid #eee;
        }

        .btn-action {
            background: #3498db;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            color: white;
        }

        /* Mengatur agar modal tidak mentok ke pinggir */
        .modal-dialog-custom {
            max-width: 90% !important;
            /* Lebar 90% dari layar */
            margin: 40px auto !important;
            /* Memberi jarak atas bawah 40px */
        }

        /* Header Modal tetap bersih (Putih) */
        .modal-header {
            background-color: #ffffff !important;
            color: #333 !important;
            border-bottom: 1px solid #dee2e6;
        }

        /* Header Tabel dibuat Biru Gelap sesuai keinginan */
        .table thead {
            background-color: #34495e !important;
            color: #ffffff !important;
        }
    </style>

    <div class="main-wrapper">
        <!-- Header Satker -->
        <div class="dashboard-card d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold m-0">Halo, KEJAKSAAN TINGGI ACEH (Penilaian Mandiri)</h5>
                <small class="text-muted">Dashboard Kertas Kerja 3.1</small>
            </div>
            <div>
                <button class="btn btn-info btn-sm text-white px-3">Siap PK</button>
                <button class="btn btn-danger btn-sm px-3">DOWNLOAD</button>
                <button class="btn btn-warning btn-sm text-white px-3" data-bs-toggle="modal"
                    data-bs-target="#modalUbahPassword">Ubah Password</button>
                <a href="/spip" class="btn btn-secondary btn-sm px-3"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOGOUT</a>

                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="dashboard-card">
            <div class="row align-items-center">
                <div class="col-md-3 fw-bold">Progres Isi: <span id="filledCount">0</span> dari 43 Parameter</div>
                <div class="col-md-9">
                    <div class="progress" style="height: 20px; position: relative;">
                        <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 0%;">
                        </div>
                        <span id="progressText"
                            style="position: absolute; width: 100%; text-align: center; color: black; font-weight: bold;">0%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Bar (Perbaikan padding dan alignment) -->
        <div class="filter-bar">
            <div class="flex-grow-1">
                <input type="text" id="searchInput" class="form-control"
                    placeholder="🔍 Cari berdasarkan Kode atau Nama Parameter...">
            </div>
            <div style="width: 250px;">
                <select id="statusFilter" class="form-select">
                    <option value="all">-- Semua Status Isian --</option>
                    <option value="filled">Sudah Diisi (Ada Grade)</option>
                    <option value="empty">Belum Diisi (-)</option>
                </select>
            </div>
        </div>

        <!-- Tabel -->
        <div class="table-container">
            <table class="table align-middle m-0">
                <thead>
                    <tr>
                        <th class="text-center align-middle ps-4" style="background-color: #34495e; color: #fff;">Kode</th>
                        <th class="text-center align-middle" style="background-color: #34495e; color: #fff;">Parameter</th>
                        <th class="text-center align-middle" style="background-color: #34495e; color: #fff;">SPIP</th>
                        <th class="text-center align-middle" style="background-color: #34495e; color: #fff;">MRI</th>
                        <th class="text-center align-middle" style="background-color: #34495e; color: #fff;">IEPK</th>
                        <th class="text-center align-middle" style="background-color: #34495e; color: #fff;">Grade PM</th>
                        <th class="text-center align-middle" style="background-color: #34495e; color: #fff;">Grade PK</th>
                        <th class="text-center" style="background-color: #34495e; color: #fff;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Pastikan nama variabel di foreach sama dengan compact() di Controller --}}
                    @foreach ($parameters as $param)
                        <tr>
                            <td class="ps-4 fw-bold">{{ $param->kode_sub_unsur }}</td>
                            <td>{{ $param->uraian_parameter }}</td>

                            {{-- Logika untuk menampilkan nama kolom jika true, atau '-' jika kosong/false --}}
                            <td class="text-center fw-bold text-primary">
                                {{ $param->spip ? 'SPIP' : '-' }}
                            </td>
                            <td class="text-center fw-bold text-success">
                                {{ $param->mri ? 'MRI' : '-' }}
                            </td>
                            <td class="text-center fw-bold text-warning">
                                {{ $param->iepk ? 'IEPK' : '-' }}
                            </td>

                            <td class="grade-pm">{{ $param->grade_pm }}</td>
                            <td class="text-center">{{ $param->grade_pk ?? '-' }}</td>

                            <td class="text-center">
                                <button class="btn-action"
                                    onclick="openModal('{{ $param->id }}', '{{ $param->kode }}', '{{ addslashes($param->nama_parameter) }}')">✎</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
       function updateDashboard() {
        const rows = document.querySelectorAll('tbody tr');
        const total = rows.length;
        let filled = 0;

        rows.forEach(row => {
            // Ambil elemen berdasarkan class, bukan index
            const gradeCell = row.querySelector('.grade-pm');
            const gradeValue = gradeCell ? gradeCell.innerText.trim() : "";

            // Logika: Hanya dianggap terisi jika bukan kosong dan bukan tanda '-'
            const isFilled = (gradeValue !== "" && gradeValue !== "-");

            if (isFilled) {
                filled++;
            }

            // Logika Filter
            const filter = document.getElementById('statusFilter').value;
            const search = document.getElementById('searchInput').value.toLowerCase();
            const text = row.innerText.toLowerCase();

            const matchSearch = text.includes(search);
            const matchStatus = (filter === 'all') ||
                                (filter === 'filled' && isFilled) ||
                                (filter === 'empty' && !isFilled);

            row.style.display = (matchSearch && matchStatus) ? '' : 'none';
        });

        // Update UI Progres
        const percent = total > 0 ? Math.round((filled / total) * 100) : 0;

        document.getElementById('filledCount').innerText = filled;
        document.getElementById('progressBar').style.width = percent + '%';
        document.getElementById('progressText').innerText = percent + '%';
    }

    // Event listener tetap sama
    document.getElementById('statusFilter').addEventListener('change', updateDashboard);
    document.getElementById('searchInput').addEventListener('keyup', updateDashboard);

    // Jalankan saat load pertama
    updateDashboard();
    </script>
    <script>
        function openModal(id, kode, nama) {
            document.getElementById('modalParameterId').value = id;
            document.getElementById('modalTitle').innerText = 'Sub Unsur ' + kode + ' - ' + nama;
            new bootstrap.Modal(document.getElementById('modalParameter')).show();
        }

        function updateForm() {
            const selected = document.querySelector('input[name="grade"]:checked').value;
            const grades = ['A', 'B', 'C', 'D', 'E'];

            // Tampilkan textarea grade yang dipilih dan grade di bawahnya
            grades.forEach(g => {
                const el = document.getElementById('input-' + g);
                // Logika: Jika grade terpilih adalah C, maka C, D, E harus muncul
                el.style.display = (grades.indexOf(g) >= grades.indexOf(selected)) ? 'block' : 'none';
            });

            // Logika AoI & Root Cause: Muncul jika pilih D atau E
            const aoiFields = document.getElementById('aoiRootCauseFields');
            aoiFields.style.display = (selected === 'E' || selected === 'D') ? 'block' : 'none';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- modal ubah password --}}
    <div class="modal fade" id="modalUbahPassword" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/spip/ubah-password" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Ubah Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Password Lama</label>
                            <input type="password" name="old_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- modal aksi --}}
    <div class="modal fade" id="modalParameter" tabindex="-1">
        {{-- Kita ganti modal-fullscreen dengan modal-dialog-custom --}}
        <div class="modal-dialog modal-xl modal-dialog-custom">
            <form action="/spip/simpan-parameter" method="POST">
                @csrf
                <input type="hidden" name="parameter_id" id="modalParameterId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-4">
                        <table class="table table-bordered mb-4">
                            <thead style="background-color: #34495e; color: #ffffff;">
                                <tr>
                                    <th>Pilih</th>
                                    <th>Grade</th>
                                    <th>Kriteria</th>
                                    <th>Penjelasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($param->criteria as $crit)
                                    <tr>
                                        <td><input type="radio" name="grade" value="{{ $crit->sub_kode }}"
                                                onchange="updateForm()" required></td>
                                        <td class="fw-bold">{{ $crit->sub_kode }}</td>
                                        <td>{{ $crit->kriteria }}</td>
                                        <td>{{ $crit->penjelasan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div id="dynamicFields">
                            @foreach (['A', 'B', 'C', 'D', 'E'] as $g)
                                <div class="card mb-3 grade-input" id="input-{{ $g }}"
                                    style="display:none;">
                                    <div class="card-header bg-secondary text-white">
                                        Uraian hasil Pengujian Grade {{ $g }}
                                    </div>
                                    <div class="card-body">
                                        <textarea name="uraian_{{ $g }}" class="form-control" rows="2"></textarea>
                                    </div>
                                </div>
                            @endforeach

                            <div class="card mb-3" id="aoiRootCauseFields" style="display:none;">
                                <div class="card-header bg-warning fw-bold">Analisis Tambahan</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="fw-bold mb-2">Uraian Area of Improvement (AoI):</label>
                                            <textarea name="aoi" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="fw-bold mb-2">Uraian Penyebab (Root Cause):</label>
                                            <textarea name="root_cause" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary px-4"
                            data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-success px-4">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </body>

</html>
