<!-- Modal -->
<div class="modal fade" id="buktiModal" tabindex="-1" aria-labelledby="buktiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buktiModalLabel">Daftar Nama File Bukti Dukung</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @if($bukti_dukung && $bukti_dukung->count())
          <ul>
            @foreach($bukti_dukung as $file)
              <li>{{ $file->id_filename }}</li>
            @endforeach
          </ul>
        @else
          <p>Tidak ada file bukti dukung.</p>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Tombol untuk membuka modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buktiModal">
  Lihat Nama File Bukti Dukung
</button>