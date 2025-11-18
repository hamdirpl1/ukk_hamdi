@extends('layouts.admin')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-edit me-2"></i>Edit Kategori
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                   id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                                   placeholder="Masukkan nama kategori" required>
                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="gb" class="form-label">Gambar Kategori</label>
                            <input type="file" class="form-control @error('gb') is-invalid @enderror"
                                   id="gb" name="gb" accept="image/*">
                            @error('gb')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Format: JPEG, PNG, JPG. Maksimal 2MB.</small>
                            @if($kategori->gb)
                                <div class="mt-2">
                                    <img src="{{ asset($kategori->gb) }}" alt="Gambar Kategori" class="img-thumbnail" style="max-width: 100px;">
                                    <small class="form-text text-muted">Gambar saat ini</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Kategori
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
}
.form-control, .form-select {
    border-radius: 0.375rem;
    border: 1px solid #ced4da;
    transition: all 0.15s ease-in-out;
}
.form-control:focus, .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}
</style>
@endsection
