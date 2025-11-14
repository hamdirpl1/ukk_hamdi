@extends('layouts.member')

@section('content')
<div class="container-fluid">   
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($toko)
    <!-- Stats Overview -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="fas fa-box text-primary"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $stats['totalProduk'] }}</h4>
                            <p class="text-muted mb-0">Total Produk</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="fas fa-eye text-success"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $stats['dilihat'] }}</h4>
                            <p class="text-muted mb-0">Dilihat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="fas fa-shopping-cart text-warning"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $stats['pesanan'] }}</h4>
                            <p class="text-muted mb-0">Pesanan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="fas fa-star text-info"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ number_format($stats['rating'], 1) }}</h4>
                            <p class="text-muted mb-0">Rating</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Store Information -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-bottom-0 pb-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Informasi Toko</h5>
                    @if($toko)
                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTokoModal">
                            <i class="fas fa-edit me-1"></i>Edit Toko
                        </button>
                    @endif
                </div>
                <div class="card-body">
                    @if($toko)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted small mb-1">Nama Toko</label>
                                <p class="mb-2 fw-semibold">{{ $toko->nama_toko }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small mb-1">Kontak</label>
                                <p class="mb-2 fw-semibold">{{ $toko->kontak_toko }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small mb-1">Alamat</label>
                                <p class="mb-0 fw-semibold">{{ $toko->alamat ?: '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border-start ps-4">
                                <div class="mb-3">
                                    <label class="form-label text-muted small mb-1">Status Toko</label>
                                    <div>
                                        <span class="badge bg-success">Aktif</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small mb-1">Bergabung Sejak</label>
                                    <p class="mb-0 fw-semibold">{{ $toko->created_at->format('d M Y') }}</p>
                                </div>
                                @if($toko->gambar)
                                <div class="mb-3">
                                    <label class="form-label text-muted small mb-1">Gambar Toko</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $toko->gambar) }}" alt="Gambar Toko" class="img-thumbnail" style="max-width: 100px;">
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <p class="text-muted">Belum memiliki toko.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            @if(!$toko)
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-center text-center py-5">
                    <div class="mb-4">
                        <div class="avatar-xl bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                            <i class="fas fa-store fa-2x text-muted"></i>
                        </div>
                        <h5 class="mb-2">Belum Memiliki Toko</h5>
                        <p class="text-muted mb-4">Buat toko pertama Anda untuk mulai berjualan</p>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-lg px-4" data-bs-toggle="modal" data-bs-target="#createTokoModal">
                            <i class="fas fa-plus me-2"></i>Buat Toko Sekarang
                        </button>
                    </div>
                </div>
            </div>
            @else
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        @if($toko->gambar)
                            <img src="{{ asset('storage/' . $toko->gambar) }}" alt="Gambar Toko" class="img-fluid rounded-circle mb-3" style="max-width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <div class="avatar-xl bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                <i class="fas fa-store fa-2x text-muted"></i>
                            </div>
                        @endif
                        <h5 class="mb-2">{{ $toko->nama_toko }}</h5>
                        <p class="text-muted">{{ $toko->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-bottom-0">
                    <h5 class="card-title mb-0">Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="card border">
                                <div class="card-body text-center p-4">
                                    <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                        <i class="fas fa-box text-primary"></i>
                                    </div>
                                    <h6 class="mb-2">Tambah Produk</h6>
                                    <p class="text-muted small mb-3">Tambahkan produk baru ke toko</p>
                                    <button class="btn btn-outline-primary btn-sm">Mulai</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border">
                                <div class="card-body text-center p-4">
                                    <div class="avatar-sm bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                        <i class="fas fa-chart-line text-success"></i>
                                    </div>
                                    <h6 class="mb-2">Lihat Statistik</h6>
                                    <p class="text-muted small mb-3">Pantau performa toko Anda</p>
                                    <button class="btn btn-outline-primary btn-sm">Lihat</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border">
                                <div class="card-body text-center p-4">
                                    <div class="avatar-sm bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                        <i class="fas fa-cog text-warning"></i>
                                    </div>
                                    <h6 class="mb-2">Pengaturan</h6>
                                    <p class="text-muted small mb-3">Kelola pengaturan toko</p>
                                    <button class="btn btn-outline-primary btn-sm">Kelola</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border">
                                <div class="card-body text-center p-4">
                                    <div class="avatar-sm bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                        <i class="fas fa-question-circle text-info"></i>
                                    </div>
                                    <h6 class="mb-2">Bantuan</h6>
                                    <p class="text-muted small mb-3">Dapatkan panduan toko</p>
                                    <button class="btn btn-outline-primary btn-sm">Bantuan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Toko Modal -->
<div class="modal fade" id="createTokoModal" tabindex="-1" aria-labelledby="createTokoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTokoModalLabel">Buat Toko Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('member.toko.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_toko" class="form-label">Nama Toko <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_toko" name="nama_toko" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kontak_toko" class="form-label">Kontak Toko <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="kontak_toko" name="kontak_toko" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Toko</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Buat Toko</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Toko Modal -->
@if($toko)
<div class="modal fade" id="editTokoModal" tabindex="-1" aria-labelledby="editTokoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTokoModalLabel">Edit Toko</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('member.toko.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nama_toko" class="form-label">Nama Toko <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_nama_toko" name="nama_toko" value="{{ $toko->nama_toko }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3">{{ $toko->deskripsi }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_kontak_toko" class="form-label">Kontak Toko <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_kontak_toko" name="kontak_toko" value="{{ $toko->kontak_toko }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="edit_alamat" name="alamat" rows="2">{{ $toko->alamat }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_gambar" class="form-label">Gambar Toko</label>
                        <input type="file" class="form-control" id="edit_gambar" name="gambar" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah.</small>
                        @if($toko->gambar)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $toko->gambar) }}" alt="Gambar Toko" class="img-thumbnail" style="max-width: 100px;">
                            </div>
                        @endif
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
@endif

<style>
.avatar-sm {
    width: 48px;
    height: 48px;
}

.avatar-xl {
    width: 80px;
    height: 80px;
}

.card {
    border: 1px solid #eef2f7;
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

.bg-opacity-10 {
    opacity: 0.1;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.form-label {
    font-size: 0.875rem;
}

.badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
}
</style>
@endsection
