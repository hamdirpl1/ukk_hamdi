@extends('layouts.admin')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Produk</h5>
            <a href="{{ route('admin.produk.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="search">
                <form class="search-form d-flex mb-3" method="GET" action="{{ route('admin.produk.index') }}">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari produk..." value="{{ request('search') }}">

                    <select name="kategori" class="form-select form-select-sm">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}" {{ request('kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>

                    <select name="toko" class="form-select form-select-sm">
                        <option value="">Semua Toko</option>
                        @foreach($tokos as $toko)
                            <option value="{{ $toko->id_toko }}" {{ request('toko') == $toko->id_toko ? 'selected' : '' }}>
                                {{ $toko->nama_toko }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-search"></i>
                    </button>
                    @if(request('search') || request('kategori') || request('toko'))
                        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="width:100%">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Toko</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Tanggal Upload</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks as $index => $produk)
                        <tr class="text-center">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $produk->nama_produk }}</td>
                            <td>{{ $produk->kategori->nama_kategori ?? 'N/A' }}</td>
                            <td>{{ $produk->toko->nama_toko ?? 'N/A' }}</td>
                            <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td>{{ $produk->tanggal_upload ? \Carbon\Carbon::parse($produk->tanggal_upload)->format('d/m/Y') : '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.produk.edit', $produk) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.produk.destroy', $produk) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk {{ $produk->nama_produk }}?')"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-box fa-2x mb-3"></i>
                                    <p>Belum ada data produk</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.table {
    font-size: 0.875rem;
}
.table th {
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
}
.table > :not(caption) > * > * {
    padding: 0.75rem 0.5rem;
}
.btn-group .btn {
    margin: 0 2px;
}
.badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
}

.search-form input:focus,
.search-form select:focus,
.search-form .btn:focus {
    outline: none !important;
    box-shadow: none !important;
}
/* Container form */
.search-form {
    display: flex;
    align-items: center;
    gap: 10px; 
    flex-wrap: nowrap;
}

/* Panjang form */
.search-form input {
    width: 280px;      /* <-- UBAH PANJANG SEARCH DI SINI */
}

.search-form select {
    width: 200px;      /* <-- UBAH PANJANG DROPDOWN DI SINI */
}

/* Style umum */
.search-form input,
.search-form select {
    border: 1px solid #dee2e6;
    font-size: 0.85rem;
    height: 34px;
    margin: 0 !important;
}

.search-form input:focus,
.search-form select:focus,
.search-form .btn:focus {
    outline: none !important;
    box-shadow: none !important;
}

/* Tombol search */
.search-form .btn {
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 12px;
    margin: 0 !important;
}
</style>
@endsection
