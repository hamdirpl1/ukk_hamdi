@extends('layouts.admin')

@section('content')
    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm rounded-circle bg-primary text-white d-flex align-items-center justify-content-center">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="mb-0">{{ $totalUsers }}</h4>
                            <p class="text-muted mb-0">Total Users</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm rounded-circle bg-success text-white d-flex align-items-center justify-content-center">
                            <i class="fas fa-store fa-lg"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="mb-0">{{ $totalTokos }}</h4>
                            <p class="text-muted mb-0">Total Toko</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm rounded-circle bg-warning text-white d-flex align-items-center justify-content-center">
                            <i class="fas fa-tags fa-lg"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="mb-0">{{ $totalKategoris }}</h4>
                            <p class="text-muted mb-0">Total Kategori</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm rounded-circle bg-info text-white d-flex align-items-center justify-content-center">
                            <i class="fas fa-box fa-lg"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="mb-0">{{ $totalProduks }}</h4>
                            <p class="text-muted mb-0">Total Produk</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Data Tables -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Toko Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Toko</th>
                                    <th>Pemilik</th>
                                    <th>Kontak</th>
                                    <th>Tanggal Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTokos as $toko)
                                <tr>
                                    <td>{{ $toko->nama_toko }}</td>
                                    <td>{{ $toko->user->nama }}</td>
                                    <td>{{ $toko->kontak_toko }}</td>
                                    <td>{{ $toko->created_at ? $toko->created_at->format('d/m/Y') : '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data toko</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                    <th>Toko</th>
                                    <th>Tanggal Upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentProduks as $produk)
                                <tr>
                                    <td>{{ $produk->nama_produk }}</td>
                                    <td>{{ $produk->kategori->nama_kategori }}</td>
                                    <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                    <td>{{ $produk->stok }}</td>
                                    <td>{{ $produk->toko->nama_toko }}</td>
                                    <td>{{ $produk->tanggal_upload ? $produk->tanggal_upload->format('d/m/Y') : '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data produk</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
