@if($indikators->isNotEmpty())
    <div class="row indikator-container">
        @foreach ($indikators as $indikator)
            <div class="col-md-6 mb-4">
                <div class="indikator-section">
                    <h5 class="indikator-title"><b>{{ $indikator->indikator_nama }}</b></h5>
                    <p class="indikator-description"><i>{{ $indikator->indikator_penjelasan }}</i></p>
                    
                    <table class="table-pengukuran">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Ditangani</th>
                                <th>Diselesaikan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ([
                                'JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 
                                'MEI', 'JUNI', 'JULI', 'AGUSTUS', 
                                'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'
                            ] as $bulan)
                                <tr>
                                    <td class="bulan">{{ $bulan }}</td>
                                    <td><input type="number" class="form-control input-box" name="ditangani[{{ $indikator->id }}][{{ $bulan }}]"></td>
                                    <td><input type="number" class="form-control input-box" name="diselesaikan[{{ $indikator->id }}][{{ $bulan }}]"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-center"><i>Tidak ada indikator untuk bidang ini.</i></p>
@endif