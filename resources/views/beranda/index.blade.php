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

.judul {
    text-align: center;
    margin: 40px 0;
    padding: 80px 20px;
    background-image: url('assets/foto/slb.png');
    background-size: cover;
    background-position: center;
    color: white;
    border-radius: 10px;
}

.judul-title {
    font-size: clamp(2rem, 5vw, 3rem);
    font-weight: 700;
    margin-bottom: 1rem;
    color: #212529;
}

.judul-subtitle {
    font-size: 1.125rem;
    color: #212529;
    line-height: 1.7;
    max-width: 600px;
    margin: 0 auto;
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
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: 0.2s ease;
        cursor: pointer;
    }

    .produk-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        /* card tetap diam, tidak bergeser */
        transform: none;
    }

    .produk-img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        background: #f2f2f2;
    }

    .produk-body {
        padding: 10px 12px;
        position: relative;
    }

    .produk-title {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 4px;
        color: #333;
        line-height: 1.3;
        height: 40px;
        overflow: hidden;
    }

    .produk-price {
        font-size: 1rem;
        font-weight: 700;
        color: #e67e22;
        margin-bottom: 6px;
    }

    /* Lokasi & Nama toko hover effect */
    .produk-location, 
    .produk-toko {
        font-size: 0.75rem;
        color: #777;
        transition: 0.25s ease;
        height: 16px;
        display: flex;
        align-items: center;
    }

    .produk-toko {
        opacity: 0;
        position: absolute;
        left: 12px;
        bottom: 10px;
    }

    .produk-card:hover .produk-location {
        opacity: 0;
    }

    .produk-card:hover .produk-toko {
        opacity: 1;
        color: #555;
    }

</style>

<section class="judul">
    <h1 class="judul-title">Temukan Produk Yang Anda Cari</h1>
    <p class="judul-subtitle">Cari dari ratusan produk berkualitas dengan harga terbaik di SmartKantin</p>
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

    <div class="produk-grid">

        @foreach($produks as $p)
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="produk-card">

                {{-- Gambar Produk --}}
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
</section>

@endsection
