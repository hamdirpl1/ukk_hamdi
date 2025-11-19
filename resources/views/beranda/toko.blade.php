@extends('layouts.beranda')

@section('content')

<style>
/* ----- container ----- */
.toko-section {
    padding: 24px 0;
}

/* info header */
.toko-header {
    margin-bottom: 18px;
    color: #222;
    font-weight: 600;
}

/* grid toko (2 columns desktop, responsive) */
.toko-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 18px;
}

/* toko card */
.toko-card {
    background: #fff;
    border-radius: 12px;
    padding: 14px;
    border: 1px solid #f0f0f0;
    box-shadow: 0 2px 10px rgba(19, 26, 33, 0.03);
    display: flex;
    flex-direction: column;
    gap: 10px;
    position: relative;
    overflow: hidden;
}

/* header bar di dalam card: logo + nama + lokasi + btn */
.toko-head {
    display: flex;
    align-items: center;
    gap: 12px;
    justify-content: space-between;
}

/* left area: logo + info */
.toko-brand {
    display: flex;
    align-items: center;
    gap: 12px;
}

/* logo */
.toko-logo {
    width: 56px;
    height: 56px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #f8f8f8;
    border: 1px solid #eee;
}
.toko-logo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* nama & alamat */
.toko-meta {
    display: flex;
    flex-direction: column;
}
.toko-name {
    font-weight: 700;
    color: #111;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.toko-location {
    font-size: 13px;
    color: #7a7a7a;
    margin-top: 2px;
}

/* tombol lihat toko (mirip Tokopedia) */
.toko-cta {
    background: transparent;
    border: 2px solid #14b866; /* hijau */
    color: #14b866;
    padding: 8px 14px;
    border-radius: 999px;
    font-weight: 700;
    font-size: 13px;
    text-decoration: none;
    transition: all .15s ease;
}
.toko-cta:hover {
    background: #14b866;
    color: #fff;
    box-shadow: 0 6px 18px rgba(20,184,102,0.14);
}

/* grid produk mini (thumbnail list) */
.toko-products {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    align-items: start;
}

/* item produk kecil */
.toko-prod {
    background: #fff;
    border-radius: 8px;
    padding: 6px;
    text-align: center;
    border: 1px solid #fafafa;
    transition: transform .12s ease, box-shadow .12s ease;
}
.toko-prod:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 18px rgba(18,22,28,0.06);
}
.toko-prod-img {
    width: 100%;
    height: 70px;
    object-fit: cover;
    border-radius: 6px;
    background: #f5f5f5;
}
.toko-prod-name {
    font-size: 12px;
    color: #333;
    margin-top: 6px;
    height: 34px;
    overflow: hidden;
    line-height: 1.15;
}
.toko-prod-price {
    margin-top: 6px;
    font-weight: 700;
    color: #e67e22;
    font-size: 13px;
}

/* kecil: badge verified / toko premium */
.toko-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #f3f0ff;
    color: #5b46ff;
    padding: 4px 8px;
    border-radius: 999px;
    font-weight: 700;
    font-size: 12px;
    margin-left: 6px;
}

/* responsive */
@media (max-width: 880px) {
    .toko-grid { grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); }
    .toko-prod-img { height: 60px; }
}
@media (max-width: 520px) {
    .toko-grid { grid-template-columns: 1fr; }
    .toko-head { align-items: flex-start; gap: 8px; }
    .toko-cta { padding: 6px 10px; font-size: 13px; }
    .toko-prod-img { height: 54px; }
}
</style>

<section class="toko-section container">
    <div class="toko-header">
        Menampilkan {{ $tokos->count() > 0 ? '1 - '.$tokos->count() : '0' }} toko
        {{-- ubah tulisan di atas sesuai kebutuhan (mis. pagination) --}}
    </div>

    <div class="toko-grid">
        @foreach($tokos as $t)
        <div class="toko-card">

            <div class="toko-head">
                <div class="toko-brand">
                    <div class="toko-logo">
                        @if(!empty($t->logo))
                            {{-- pakai storage jika logo disimpan di storage --}}
                            <img src="{{ asset('storage/' . $t->logo) }}" alt="{{ $t->nama_toko }}">
                        @else
                            <img src="{{ asset('assets/foto/noimage.png') }}" alt="no logo">
                        @endif
                    </div>

                    <div class="toko-meta">
                        <div class="toko-name">
                            {{ $t->nama_toko }}
                            {{-- contoh badge verified (opsional) --}}
                            @if(isset($t->is_verified) && $t->is_verified)
                                <span class="toko-badge">✔ Toko Terverifikasi</span>
                            @endif
                        </div>
                        <div class="toko-location">
                            {{ $t->alamat ?? 'Lokasi tidak tersedia' }}
                        </div>
                    </div>
                </div>

                <div>
                    <a href="" class="toko-cta">Lihat Toko</a>
                </div>
            </div>

            {{-- produk mini: tampilkan 4 produk (jika kurang, tampilkan sesuai jumlah) --}}
            <div class="toko-products" aria-hidden="false">
                @php
                    $mini = $t->produk->take(4);
                @endphp

                @if($mini->count() == 0)
                    {{-- placeholder 4 box jika tidak ada produk --}}
                    @for($i=0;$i<4;$i++)
                        <div class="toko-prod">
                            <img class="toko-prod-img" src="{{ asset('assets/foto/noimage.png') }}" alt="no image">
                            <div class="toko-prod-name">-</div>
                            <div class="toko-prod-price">-</div>
                        </div>
                    @endfor
                @else
                    @foreach($mini as $pr)
                        <a href=" style="text-decoration:none;color:inherit;">
                            <div class="toko-prod">
                                @if($pr->gambar->count() > 0)
                                    <img class="toko-prod-img" src="{{ asset('storage/' . $pr->gambar->first()->gambar) }}" alt="{{ $pr->nama_produk }}">
                                @else
                                    <img class="toko-prod-img" src="{{ asset('assets/foto/noimage.png') }}" alt="no image">
                                @endif

                                <div class="toko-prod-name">{{ Str::limit($pr->nama_produk, 40) }}</div>
                                <div class="toko-prod-price">Rp{{ number_format($pr->harga,0,',','.') }}</div>
                            </div>
                        </a>
                    @endforeach

                    {{-- jika produk kurang dari 4, tambahkan placeholder agar layout konsisten --}}
                    @if($mini->count() < 4)
                        @for($i=0; $i < (4 - $mini->count()); $i++)
                            <div class="toko-prod">
                                <img class="toko-prod-img" src="{{ asset('assets/foto/noimage.png') }}" alt="no image">
                                <div class="toko-prod-name">-</div>
                                <div class="toko-prod-price">-</div>
                            </div>
                        @endfor
                    @endif
                @endif
            </div>

        </div>
        @endforeach
    </div>

    {{-- pagination (opsional) --}}
    <div class="mt-4">
        @if(method_exists($tokos, 'links'))
            {{ $tokos->links() }}
        @endif
    </div>
</section>

@endsection
