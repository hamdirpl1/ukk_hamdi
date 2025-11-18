<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

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

        /* =====================================
                    NAVBAR
        ====================================== */
        .navbar {
            background: #fff;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .logo span {
            color: var(--primary);
        }

        .nav-menu {
            display: flex;
            gap: 1.2rem;
            align-items: center;
            white-space: nowrap;
            list-style: none; /* Menghilangkan titik pada menu */
        }

        .nav-link {
            padding: 0.5rem 1rem;
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--text-dark);
            transform: translateY(-2px);
        }

        .nav-link::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 80%;
        }

        /* =====================================
            SEARCH BAR (TOKOPEDIA STYLE)
        ====================================== */
        .search-container {
            flex: 1;           /* search jadi melebar otomatis */
            max-width: 550px;
        }

        .search-form {
            display: flex;
            width: 100%;
        }

        .search-input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 2px solid var(--primary);
            border-radius: 8px 0 0 8px;
            outline: none;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .search-button {
            border: none;
            cursor: pointer;
            padding: 0 1.5rem;
            color: #fff;
            background: var(--primary);
            border-radius: 0 8px 8px 0;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 50px; /* Memberikan lebar minimum untuk tombol */
        }

        .search-button:hover {
            background: var(--secondary);
        }

        /* =====================================
                    MAIN
        ====================================== */
        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            min-height: calc(100vh - 160px);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #f0f9ff 0%, #e1f5fe 100%);
            border-radius: 12px;
            padding: 3rem 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .hero p {
            font-size: 1.1rem;
            color: var(--text-gray);
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        /* Product Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .product-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .product-info {
            padding: 1rem;
        }

        .product-name {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .product-price {
            font-weight: 600;
            color: var(--primary);
            font-size: 1.1rem;
        }

        /* =====================================
                    FOOTER
        ====================================== */
        footer {
            background: #fff;
            padding: 2rem 0;
            border-top: 1px solid #e2e8f0;
            font-size: 0.9rem;
            color: #4a5568;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer-top {
            display: flex;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .footer-section {
            flex: 1;
            min-width: 200px;
        }

        .footer-section h3 {
            font-size: 1.1rem;
            margin-bottom: 1rem;
            font-weight: 600;
            color: #1a202c;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            text-decoration: none;
            color: #4a5568;
            transition: 0.3s;
        }

        .footer-links a:hover {
            color: var(--primary);
        }

        .footer-bottom {
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            width: 36px;
            height: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f7fafc;
            border-radius: 50%;
            color: #4a5568;
            transition: 0.3s;
        }

        .social-link:hover {
            color: #fff;
            background: var(--primary);
            transform: translateY(-2px);
        }

        /* =====================================
                    RESPONSIVE
        ====================================== */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
            }

            .search-container {
                margin: 1rem 0;
                width: 100%;
            }

            .footer-top {
                flex-direction: column;
            }

            .footer-bottom {
                text-align: center;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-container">
        
            <a href="/" class="logo">Slb<span>Kantin</span></a>
        
            <!-- SEARCH DI DALAM NAVBAR -->
            <div class="search-container">
                <form class="search-form" id="searchForm">
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari makanan, minuman, dan lainnya...">
                    <button type="submit" class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        
            <ul class="nav-menu">
                <li><a href="/" class="nav-link">Beranda</a></li>
                <li><a href="/produk" class="nav-link">Produk</a></li>
                <li><a href="/toko" class="nav-link">Toko</a></li>
                <li><a href="/kontak" class="nav-link">Kontak</a></li>
            </ul>
        </div>
    </nav>


    <!-- CONTENT -->
    <main>
        @yield('content')    
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-container">

            <div class="footer-top">
                <div class="footer-section">
                    <h3>SlbKantin</h3>
                    <ul class="footer-links">
                        <li><a href="/tentang">Tentang Kami</a></li>
                        <li><a href="/karir">Karir</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="/affiliate">Program Affiliate</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Beli</h3>
                    <ul class="footer-links">
                        <li><a href="/tagihan">Tagihan</a></li>
                        <li><a href="/topup">Top Up & Tagihan</a></li>
                        <li><a href="/travel">Travel & Entertainment</a></li>
                        <li><a href="/elektronik">Elektronik</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Bantuan & Panduan</h3>
                    <ul class="footer-links">
                        <li><a href="/pusat-bantuan">Pusat Bantuan</a></li>
                        <li><a href="/cara-belanja">Cara Berbelanja</a></li>
                        <li><a href="/cara-bayar">Cara Pembayaran</a></li>
                        <li><a href="/pengembalian">Pengembalian Barang</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Jual</h3>
                    <ul class="footer-links">
                        <li><a href="/jual">Mulai Berjualan</a></li>
                        <li><a href="/promo">Promo Toko</a></li>
                        <li><a href="/affiliate-seller">Program Affiliate Seller</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Keamanan & Privasi</h3>
                    <ul class="footer-links">
                        <li><a href="/privasi">Kebijakan Privasi</a></li>
                        <li><a href="/syarat">Syarat & Ketentuan</a></li>
                        <li><a href="/keamanan">Panduan Keamanan</a></li>
                        <li><a href="/penipuan">Laporkan Penipuan</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-copyright">
                    &copy; 2023 SlbKantin. All rights reserved.
                </div>

                <div class="footer-social">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

        </div>
    </footer>

    <script>
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        
        // Handle form submission
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = searchInput.value.trim();
            if (query) {
                alert(`Mencari: ${query}`);
                // In a real application, you would redirect to search results page
                // window.location.href = `/search?q=${encodeURIComponent(query)}`;
            }
        });
    </script>

</body>
</html>