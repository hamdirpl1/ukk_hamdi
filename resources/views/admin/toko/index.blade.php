@extends('layouts.admin')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Toko</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="width:100%">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th>Nama Toko</th>
                            <th width="10%">Logo</th>
                            <th>Pemilik</th>
                            <th>Alamat</th>
                            <th>Kontak Toko</th>
                            <th>Tanggal Dibuat</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tokos as $index => $toko)
                        <tr class="text-center">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $toko->nama_toko }}</td>
                            <td>
                                @if ($toko->gambar)
                                <img src="{{ asset('storage/' . $toko->gambar) }}" alt="Logo" width="35" height="35" class="rounded-circle">
                            @else
                                <span class="bagde bg-secondary">Tidak Ada</span>
                            @endif
                            </td>
                            <td>{{ $toko->user->nama ?? 'N/A' }}</td>
                            <td>{{ $toko->alamat }}</td>
                            <td>{{ $toko->kontak_toko }}</td>
                            <td>{{ $toko->created_at ? $toko->created_at->format('d/m/Y') : '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.toko.edit', $toko) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.toko.destroy', $toko) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus toko {{ $toko->nama_toko }}?')"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted
">
                                    <i class="fas fa-store fa-2x mb-3"></i>
                                    <p>Belum ada data toko</p>
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
</style>
@endsection