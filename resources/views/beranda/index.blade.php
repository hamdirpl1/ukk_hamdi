@extends('layouts.beranda')

@section('content')
<style>
:root {
    --primary: #4361ee;
    --secondary: #3f37c9;
    --accent: #4cc9f0;
    --light: #f8f9fa;
    --dark: #212529;
    --success: #4bb543;
    --text-dark: #1a202c;
    --text-gray: #4a5568;
}
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body {
    background-color: var(--light);
    color: var(--dark);
    line-height: 1.6;
}

/* ============================
    CATEGORY
   ============================ */
.categories-section {
    margin-bottom: 3rem;
}
.section-title {
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    position: relative;
    display: inline-block;
}
.section-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 60px;
    height: 4px;
    background-color: var(--accent);
    border-radius: 2px;
}
.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
    gap: 1.5rem;
}
.category-card {
    text-align: center;
    cursor: pointer;
     transition: .2s ease;
}
.category-card:hover {
    transform: translateY(-5px);
}

.category-image img {
    width: 70px;
    height: 70px;
    object-fit: contain;
}
.category-name {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-dark);
}

/* ============================
    PRODUCT CARD
   ============================ */
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
}

.product-card {
    width: 90%;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid #eee;
    transition: 0.2s ease;
    padding-bottom: 0;
}

.product-card:hover {
    box-shadow: 0 5px 12px rgba(0,0,0,0.08);
    transform: translateY(-3px);
}

/* badge */
.product-badge {
    position: absolute;
    background: #ff3d3d;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    padding: 4px 7px;
    border-bottom-right-radius: 6px;
    top: 0;
    left: 0;
}

/* image */
.product-image-container {
    position: relative;
    width: 100%;
    height: 220px;
    background: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.product-image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* info */
.product-info {
    padding: 10px;
}
.product-name {
    font-size: 14px;
    font-weight: 500;
    color: #333;
    margin-bottom: 5px;
    line-height: 1.3em;
    height: 38px;
    overflow: hidden;
}
.product-price-main {
    font-size: 18px;
    font-weight: 700;
    color: #111;
}
.product-price-strike {
    font-size: 13px;
    color: #888;
    text-decoration: line-through;
    margin-left: 4px;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 13px;
    color: #555;
    margin-top: 6px;
}
.product-rating i {
    color: #FFD43B;
}
.product-location {
    font-size: 13px;
    color: #666;
    margin-top: 5px;
}

/* ============================
    BUTTON DETAIL (NEW)
   ============================ */
.product-detail-btn {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: var(--primary);
    color: #fff;
    text-align: center;
    font-weight: 600;
    border-radius: 0 0 10px 10px;
    transition: 0.2s;
    text-decoration: none;
}
.product-detail-btn:hover {
    background-color: #3f37c9;
}
.product-detail-btn:active {
    transform: scale(0.98);
}

</style>

<section class="search-section">
    <h1 class="search-title">Temukan Produk Yang Anda Cari</h1>
    <p class="search-subtitle">Cari dari ratusan produk berkualitas dengan harga terbaik di SmartKantin</p>
</section>

<!-- ============================
        KATEGORI
============================ -->
<section class="categories-section">
    <h2 class="section-title">Kategori Produk</h2>

    <div class="categories-grid">
        @foreach($kategoris as $item)
        <div class="category-card">
            <div class="category-image">
                @if ($item->gb)
                    <img src="{{ asset($item->gb) }}" alt="{{ $item->nama_kategori }}">
                @else
                    <img src="" alt="{{ $item->nama_kategori }}">
                @endif
            </div>
            <h3 class="category-name">{{ $item->nama_kategori }}</h3>
        </div>
        @endforeach
    </div>
</section>


<!-- ============================
        PRODUK UNGGULAN
============================ -->
<section class="featured-section">
    <h2 class="section-title">Produk Unggulan</h2>

    <div class="product-grid">
        @foreach($produks as $p)
        <div class="product-card">

            @if($p->diskon > 0)
            <div class="product-badge">{{ $p->diskon }}%</div>
            @endif

            <div class="product-image-container">
                @if($p->gambar->count() > 0)
                    <img src="{{ asset('storage/' . $p->gambar->first()->gambar) }}" alt="{{ $p->nama_produk }}">
                @else
                    <img src="" alt="{{ $p->nama_produk }}">
                @endif
            </div>

            <div class="product-info">
                <div class="product-name">{{ $p->nama_produk }}</div>

                <div>
                    <span class="product-price-main">
                        Rp{{ number_format($p->harga)}}
                    </span>
                </div>

                <div class="product-rating">
                    <i class="fas fa-star"></i> 
                    <span>{{'4.9' }}</span> • 
                    <span>{{'1rb+' }} terjual</span>
                </div>

                <div class="product-location">
                    <i class="fas fa-map-marker-alt"></i> {{ $p->toko->alamat ?? 'Alamat tidak tersedia' }}
                    <i class="fas fa-store-alt"></i> {{ $p->toko->nama_toko ?? 'Alamat tidak tersedia' }}
                </div>
            </div>
            <a href="#" class="product-detail-btn">Detail</a>
        </div>
        @endforeach
    </div>
</section>

@endsection
