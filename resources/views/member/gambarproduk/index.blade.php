@extends('layouts.member')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Gambar Produk</h5>
            <a href="{{ route('member.gambarproduk.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Gambar Produk
            </a>
        </div>
        <div class="card-body">
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

            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="width:100%">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="15%">Gambar</th>
                            <th>Nama Gambar</th>
                            <th>Produk</th>
                            <th>Tanggal Dibuat</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gambarProduks as $gambar)
                        <tr class="text-center">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                @if ($gambar->gambar)
                                    <img src="{{ asset('storage/' . $gambar->gambar) }}" alt="Gambar Produk" width="40" height="40" class="rounded-circle">
                                @else
                                    <span class="badge bg-secondary">Tidak Ada</span>
                                @endif
                            <td class="fw-semibold">{{ $gambar->nama_gambar }}</td>
                            <td>{{ $gambar->produk->nama_produk ?? 'N/A' }}</td>
                            <td>{{ $gambar->created_at ? \Carbon\Carbon::parse($gambar->created_at)->format('d/m/Y') : '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('member.gambarproduk.edit', $gambar) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('member.gambarproduk.destroy', $gambar) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus gambar produk {{ $gambar->nama_gambar }}?')"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-images fa-2x mb-3"></i>
                                    <p>Belum ada data gambar produk</p>
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
</style>
@endsection
