@extends('layouts.beranda')

@section('content')

<style>

    /* ========== SORT DROPDOWN (TOKOPEDIA STYLE) ========== */
    .sort-container {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 18px;
        position: relative;
    }

    .sort-btn {
        background: #ffffff;
        border: 1px solid #dcdcdc;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: 0.2s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .sort-btn:hover {
        background: #f5f6f7;
    }

    .sort-btn i {
        transition: 0.25s;
    }

    /* rotate saat dropdown terbuka */
    .sort-btn.active i {
        transform: rotate(180deg);
    }

    .sort-dropdown {
        position: absolute;
        top: 48px;
        right: 0;
        width: 190px;
        background: white;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        padding: 6px 0;
        opacity: 0;
        pointer-events: none;
        transform: translateY(5px);
        transition: 0.2s ease;
        z-index: 20;
    }

    .sort-dropdown.show {
        opacity: 1;
        pointer-events: auto;
        transform: translateY(0px);
    }

    .sort-item {
        padding: 10px 16px;
        font-size: 14px;
        cursor: pointer;
        color: #444;
        transition: 0.15s;
    }

    .sort-item:hover {
        background: #f1f3f4;
    }

    .sort-active {
        font-weight: 700;
        color: #3b5bfd;
        background: #eef1ff;
    }

    .sort-dropdown a{
        text-decoration: none;
        color: inherit;
    }


    /* ========== PRODUK CARD ========== */
    .produk-section {
        padding: 20px 0;
    }

    .produk-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 16px;
    }

    .produk-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: 0.2s ease;
        cursor: pointer;
    }

    .produk-card:hover {
        box-shadow: 0 5px 14px rgba(0,0,0,0.12);
    }

    .produk-img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        background: #f2f2f2;
    }

    .produk-body {
        padding: 12px 14px;
        position: relative;
    }

    .produk-title {
        font-size: 0.92rem;
        font-weight: 600;
        margin-bottom: 6px;
        color: #333;
        line-height: 1.4;
        height: 40px;
        overflow: hidden;
    }

    .produk-price {
        font-size: 1rem;
        font-weight: 700;
        color: #e67e22;
        margin-bottom: 6px;
    }

    .produk-location, 
    .produk-toko {
        font-size: 0.75rem;
        color: #777;
        display: flex;
        align-items: center;
        height: 16px;
        transition: 0.25s ease;
    }

    .produk-toko {
        opacity: 0;
        position: absolute;
        left: 14px;
        bottom: 12px;
    }

    .produk-card:hover .produk-location {
        opacity: 0;
    }

    .produk-card:hover .produk-toko {
        opacity: 1;
        color: #555;
    }
</style>

<div class="container produk-section">
    
    <h3 class="mb-3">Produk Tersedia</h3>

    <!-- Dropdown Sort -->
    <div class="sort-container">
        <div class="sort-btn" onclick="toggleSort()" id="sortBtn">
            Urutkan
            <i class="fas fa-chevron-down"></i>
        </div>

        <div class="sort-dropdown" id="sortMenu">
            <a href="?sort=terbaru"><div class="sort-item {{ request('sort')=='terbaru'?'sort-active':'' }}">Terbaru</div></a>
            <a href="?sort=termurah"><div class="sort-item {{ request('sort')=='termurah'?'sort-active':'' }}">Harga Termurah</div></a>
            <a href="?sort=termahal"><div class="sort-item {{ request('sort')=='termahal'?'sort-active':'' }}">Harga Termahal</div></a>
            <a href="?sort=terlaris"><div class="sort-item {{ request('sort')=='terlaris'?'sort-active':'' }}">Terlaris</div></a>
        </div>
    </div>

    <!-- Produk -->
    <div class="produk-grid">

        @foreach($produks as $p)
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="produk-card">

                @if($p->gambar->count() > 0)
                    <img class="produk-img" 
                        src="{{ asset('storage/' . $p->gambar->first()->gambar) }}" 
                        alt="{{ $p->nama_produk }}">
                @else
                    <img class="produk-img" 
                        src="{{ asset('assets/foto/noimage.png') }}" 
                        alt="Tidak ada gambar">
                @endif

                <div class="produk-body">
                    <div class="produk-title">{{ $p->nama_produk }}</div>

                    <div class="produk-price">
                        Rp{{ number_format($p->harga, 0, ',', '.') }}
                    </div>

                    <div class="produk-location">
                        <i class="fas fa-map-marker-alt"></i>&nbsp; 
                        {{ $p->toko->alamat ?? 'Alamat tidak tersedia' }}
                    </div>

                    <div class="produk-toko">
                        <i class="fas fa-store"></i>&nbsp; 
                        {{ $p->toko->nama_toko ?? 'Toko Tidak Diketahui' }}
                    </div>

                </div>
            </div>
        </a>
        @endforeach

    </div>
</div>

<script>
    function toggleSort() {
        const menu = document.getElementById('sortMenu');
        const btn = document.getElementById('sortBtn');

        menu.classList.toggle('show');
        btn.classList.toggle('active');
    }

    document.addEventListener('click', function(event) {
        const isBtn = event.target.closest('.sort-btn');
        const isMenu = event.target.closest('.sort-dropdown');

        if (!isBtn && !isMenu) {
            document.getElementById('sortMenu').classList.remove('show');
            document.getElementById('sortBtn').classList.remove('active');
        }
    });
</script>

@endsection
