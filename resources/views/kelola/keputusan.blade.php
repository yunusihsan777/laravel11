@extends('layouts.app')

@section('title', 'Kep Tim SAKIP')

@section('content')
<div class="content" id="content">
    <div class="container-fluid">
        <h2>Keputusan</h2>
    <div class="container mt-5">
        <div class="card border-light shadow-sm">
            <div class="card-body">
                <center>
                    <h2><b>Sinergi Continuous Improvement - AKIP Kejaksaan RI</b></h2>
                </center><br><br>
                <div class="text mb-4">
                    <h5><b>Upload Keputusan Tim Pelaksana AKIP</b></h5>
                    <p>Hai sobat adhyaksa, untuk memulai mengisikan pelaksanaan AKIP anda harus upload terlebih dahulu Keputusan Tim Pelaksana AKIP. Anda pasti tahu bahwa komponen indikator dalam AKIP adalah seluruh bidang atau bagian yang ada pada satker anda yang dapat menuangkan perencanaan dan target sasaran yang hendak dilakukan. Klik upload file untuk memulai. File yang di ijinkan untuk diupload adalah file PDF. oleh karena proses upload ini tidak bisa di ulang (untuk mengubah anda harus mengirimkan surat secara berjenjang oleh karena kelalaian anda) dan mulailah berlajar untuk bertanggungjawab atas apa yang diupload. sudak dicek dan cek ulang terlebih dahulu. Salam Perubahan.
                        Risiko Kebijakan, Risiko Reputasi, Risiko Hukum, Risiko Keuangan, Risiko Operasional, Risiko Pelaporan, Risiko Kepatuhan</p>
                </div>

                <!-- File Upload Form -->
                <form id="upload-form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label d-block">
                            <input type="file" class="form-control form-control-sm mx-auto" id="file" name="file" accept=".pdf">
                        </label>
                        <div class="form-text text-center">Maximum size: 2MB</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form><br>
                <center><p style="color: red;">TIDAK ADA METODE PERBAIKAN UPLOAD. PASTIKAN YANG DIUPLOAD SUDAH BENAR FILE DAN ISINYA </p>
                <p>Spirit of responsibility - Semangat bertanggungjawab </p>
                <b><p>#beraniuntukberubah #beboldandmakechanges</p></b></center>
            </div>
        </div>
    </div>

    <!-- Popup Notification -->
    <div class="modal fade" id="uploadSuccessModal" tabindex="-1" aria-labelledby="uploadSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadSuccessModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    The file has been uploaded successfully!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

{{-- @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('upload-form').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const formData = new FormData(this);
            fetch('{{ route('upload.file') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    var myModal = new bootstrap.Modal(document.getElementById('uploadSuccessModal'));
                    myModal.show();
                } else {
                    alert('Error uploading file.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
@endsection --}}
