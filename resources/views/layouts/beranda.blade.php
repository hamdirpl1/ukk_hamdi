<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SlbKantin</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/foto/lg.png') }}">

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

        /* NAVBAR */
        .navbar {
            background: #fff;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
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
            list-style: none;
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

        /* SEARCH */
        .search-container {
            flex: 1;
            max-width: 550px;
        }

        .search-form input:focus,
        .search-form select:focus,
        .search-form .btn:focus {
            outline: none !important;
            box-shadow: none !important;
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
        }

        .search-button:hover {
            background: var(--secondary);
        }

        /* MAIN */
        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            min-height: calc(100vh - 160px);
        }

        /* FOOTER */
        footer {
            background: #fff;
            padding: 2rem 0 1rem;
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
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .footer-section {
            flex: 1;
            min-width: 200px;
        }

        .footer-section h3 {
            font-size: 1rem;
            margin-bottom: 0.8rem;
            font-weight: 600;
            color: #1a202c;
        }

        .footer-links {
            list-style: none;
            line-height: 1.4;
        }

        .footer-links li {
            margin-bottom: 0.3rem;
        }

        .footer-links a {
            text-decoration: none;
            color: #4a5568;
            transition: 0.3s;
            font-size: 0.85rem;
            display: block;
            padding: 0.1rem 0;
        }

        .footer-links a:hover {
            color: var(--primary);
            transform: translateX(3px);
        }

        .footer-bottom {
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            font-size: 0.8rem;
        }

        .footer-social {
            display: flex;
            gap: 0.8rem;
        }

        .social-link {
            width: 32px;
            height: 32px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f7fafc;
            border-radius: 50%;
            color: #4a5568;
            transition: 0.3s;
            text-decoration: none;
        }

        .social-link:hover {
            color: #fff;
            background: var(--primary);
            transform: translateY(-2px);
        }

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
                        <li>
                            <a href="/tentang">
                                SLB Kantin adalah kantin yang menyediakan berbagai kebutuhan harian bagi siswa dan guru. Kami menyajikan aneka makanan, minuman, snack, serta alat tulis dengan harga yang terjangkau dan kualitas yang terjaga. Dengan suasana yang bersih, ramah, dan nyaman, SLB Kantin hadir untuk mendukung aktivitas belajar dengan menyediakan segala kebutuhan sekolah dalam satu tempat.
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Beli</h3>
                    <ul class="footer-links">
                        <li><a href="/tagihan">Makanan</a></li>
                        <li><a href="/topup">Minuman</a></li>
                        <li><a href="/travel">Snack</a></li>
                        <li><a href="/elektronik">Alat Tulis</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3></h3>
                    <ul class="">
                        
                    </ul>
                </div>

            </div>

            <div class="footer-bottom">
                <div>&copy; 2023 SlbKantin. All rights reserved.</div>

                <div class="footer-social">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

        </div>
    </footer>

</body>
</html>
