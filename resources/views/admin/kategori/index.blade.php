    @extends('layouts.admin')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Kategori</h5>
            <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="width:100%">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="15%">Gambar</th>
                            <th>Nama Kategori</th>
                            <th>Tanggal Dibuat</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $index => $kategori)
                        <tr class="text-center">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                @if($kategori->gb)
                                    <img src="{{ asset($kategori->gb) }}" alt="Gambar Kategori" width="40" height="40" class="rounded-circle">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $kategori->nama_kategori }}</td>
                            <td>{{ $kategori->created_at ? $kategori->created_at->format('d/m/Y') : '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $kategori->nama_kategori }}?')"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-list fa-2x mb-3"></i>
                                    <p>Belum ada data kategori</p>
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
