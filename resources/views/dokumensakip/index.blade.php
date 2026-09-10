@extends('layouts.app')

@section('title', 'Dokumen SAKIP - Kelola Data')

@section('content')
<div class="content" id="content">
    <div class="container-fluid px-0">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-collection-fill text-gold-dark me-2"></i>Kelola Dokumen & Pedoman SAKIP</h5>
                <button type="button" class="btn btn-emerald btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Dokumen
                </button>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>URL</th>
                                <th>Icon</th>
                                <th>Urutan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dokumen as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>
                                        @if($item->kategori == 'pedoman_ketentuan')
                                            <span class="badge bg-danger">Pedoman & Ketentuan</span>
                                        @elseif($item->kategori == 'template_tahun_berjalan')
                                            <span class="badge bg-success">Template Berjalan</span>
                                        @else
                                            <span class="badge bg-secondary">Arsip Template</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold">{{ $item->judul }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td><a href="{{ $item->url }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-link-45deg"></i> Link</a></td>
                                    <td class="text-center"><i class="bi {{ $item->icon }} fs-5"></i><br><small>{{ $item->icon }}</small></td>
                                    <td class="text-center">{{ $item->urutan }}</td>
                                    <td class="text-center">
                                        @if($item->is_active)
                                            <span class="badge bg-success"><i class="bi bi-check-circle"></i> Aktif</span>
                                        @else
                                            <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Dokumen SAKIP</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('dokumen-sakip.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Kategori</label>
                                                        <select class="form-select" name="kategori" required>
                                                            <option value="pedoman_ketentuan" {{ $item->kategori == 'pedoman_ketentuan' ? 'selected' : '' }}>Pedoman & Ketentuan</option>
                                                            <option value="template_tahun_berjalan" {{ $item->kategori == 'template_tahun_berjalan' ? 'selected' : '' }}>Template Dokumen SAKIP Tahun Aktif</option>
                                                            <option value="arsip_template" {{ $item->kategori == 'arsip_template' ? 'selected' : '' }}>Arsip Template Dokumen SAKIP</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Judul</label>
                                                        <input type="text" class="form-control" name="judul" value="{{ $item->judul }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Deskripsi</label>
                                                        <input type="text" class="form-control" name="deskripsi" value="{{ $item->deskripsi }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">URL (Link G-Drive)</label>
                                                        <input type="url" class="form-control" name="url" value="{{ $item->url }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Class Icon (Bootstrap Icons)</label>
                                                        <input type="text" class="form-control" name="icon" value="{{ $item->icon }}" placeholder="bi-file-earmark-pdf-fill text-danger">
                                                        <small class="text-muted">Gunakan class icon dari bootstrap icon. Contoh: bi-file-earmark-pdf-fill text-danger</small>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Urutan Tampil</label>
                                                        <input type="number" class="form-control" name="urutan" value="{{ $item->urutan }}">
                                                    </div>
                                                    <div class="mb-3 form-check">
                                                        <input type="checkbox" class="form-check-input" name="is_active" id="isActive{{ $item->id }}" {{ $item->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="isActive{{ $item->id }}">Aktif Ditampilkan</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Dokumen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('dokumen-sakip.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus dokumen <strong>{{ $item->judul }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">Belum ada data dokumen.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Dokumen SAKIP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dokumen-sakip.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" name="kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="pedoman_ketentuan">Pedoman & Ketentuan</option>
                            <option value="template_tahun_berjalan">Template Dokumen SAKIP Tahun Aktif</option>
                            <option value="arsip_template">Arsip Template Dokumen SAKIP</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" required placeholder="Contoh: Pedoman JA Nomor 4">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi" placeholder="Penjelasan singkat...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL (Link G-Drive)</label>
                        <input type="url" class="form-control" name="url" required placeholder="https://drive.google.com/...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Class Icon (Bootstrap Icons)</label>
                        <input type="text" class="form-control" name="icon" placeholder="bi-file-earmark-pdf-fill text-danger" value="bi-file-earmark-pdf-fill text-danger">
                        <small class="text-muted">Gunakan class icon dari bootstrap icon. Contoh: bi-file-earmark-pdf-fill text-danger</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" class="form-control" name="urutan" value="0">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="is_active" id="isActiveCreate" checked>
                        <label class="form-check-label" for="isActiveCreate">Aktif Ditampilkan</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-emerald">Simpan Dokumen</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
