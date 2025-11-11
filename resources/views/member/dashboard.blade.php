@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard Member</h4>
                <p class="page-title-sub">Selamat datang di panel member sistem e-commerce</p>
            </div>
        </div>
    </div>

    <!-- Toko Information -->
    @if($toko)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informasi Toko</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Nama Toko: {{ $toko->nama_toko }}</h6>
                            <p class="text-muted mb-1">Kontak: {{ $toko->kontak_toko }}</p>
                            <p class="text-muted mb-1">Alamat: {{ $toko->alamat ?: 'Belum diisi' }}</p>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-box fa-lg"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0">{{ $totalProduks }}</h4>
                                    <p class="text-muted mb-0">Total Produk</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-store fa-3x text-muted mb-3"></i>
                    <h5>Anda belum memiliki toko</h5>
                    <p class="text-muted">Silakan buat toko terlebih dahulu untuk mulai berjualan.</p>
                    <a href="#" class="btn btn-primary">Buat Toko</a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Products -->
    @if($toko && $recentProduks->count() > 0)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Produk Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Tanggal Upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentProduks as $produk)
                                <tr>
                                    <td>{{ $produk->nama_produk }}</td>
                                    <td>{{ $produk->kategori->nama_kategori }}</td>
                                    <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                    <td>{{ $produk->stok }}</td>
                                    <td>{{ $produk->tanggal_upload ? $produk->tanggal_upload->format('d/m/Y') : '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-outline-primary w-100">
                                <i class="fas fa-plus-circle me-2"></i>Tambah Produk
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-outline-success w-100">
                                <i class="fas fa-list me-2"></i>Kelola Produk
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-outline-warning w-100">
                                <i class="fas fa-chart-line me-2"></i>Laporan Penjualan
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="#" class="btn btn-outline-info w-100">
                                <i class="fas fa-cog me-2"></i>Pengaturan Toko
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
