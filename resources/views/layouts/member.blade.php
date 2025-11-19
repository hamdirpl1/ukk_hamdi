<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member SlbKantin</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/foto/lg.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        :root {
            --sidebar-width: 260px;
            --navbar-height: 60px;
        }

        /* Sidebar Formal & Minimalis */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background-color: #2c3e50;
            color: #ecf0f1;
            z-index: 1000;
            border-right: 1px solid #34495e;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #34495e;
            text-align: center;
        }

        .company-logo {
            width: 50px;
            height: 50px;
            background-color: #3498db;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .company-logo i {
            font-size: 24px;
            color: white;
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #ecf0f1;
        }

        .sidebar-menu {
            flex: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .menu-section {
            margin-bottom: 25px;
        }

        .section-title {
            padding: 0 20px 8px;
            margin: 0;
            font-size: 11px;
            font-weight: 600;
            color: #95a5a6;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin: 2px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background-color: #34495e;
            color: #ecf0f1;
        }

        .menu-item.active {
            background-color: #34495e;
            color: #3498db;
            border-left-color: #3498db;
            font-weight: 500;
        }

        .menu-item i {
            width: 20px;
            margin-right: 12px;
            font-size: 14px;
            text-align: center;
        }

        .menu-item span {
            font-size: 14px;
            font-weight: 400;
        }

        .sidebar-footer {
            padding: 15px 20px;
            border-top: 1px solid #34495e;
            background-color: #34495e;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: #7f8c8d;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }

        .user-avatar i {
            font-size: 20px;
            color: #ecf0f1;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: #ecf0f1;
        }

        .user-role {
            font-size: 12px;
            color: #bdc3c7;
        }

        /* Scrollbar untuk sidebar */
        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-menu::-webkit-scrollbar-track {
            background: #34495e;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: #7f8c8d;
            border-radius: 2px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: #95a5a6;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            min-height: 100vh;
            background-color: #f8f9fa;
            transition: margin-left 0.3s ease;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .sidebar-header h3,
            .section-title,
            .menu-item span,
            .user-details {
                display: none;
            }
            
            .company-logo {
                width: 40px;
                height: 40px;
                margin-bottom: 0;
            }
            
            .company-logo i {
                font-size: 18px;
            }
            
            .menu-item {
                justify-content: center;
                padding: 15px;
                border-left: none;
                border-right: 3px solid transparent;
            }
            
            .menu-item.active {
                border-left: none;
                border-right-color: #3498db;
            }
            
            .menu-item i {
                margin-right: 0;
                font-size: 16px;
            }
            
            .user-info {
                justify-content: center;
            }
            
            .user-avatar {
                margin-right: 0;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar.active {
                width: var(--sidebar-width);
                transform: translateX(0);
            }
            
            .sidebar.active .sidebar-header h3,
            .sidebar.active .section-title,
            .sidebar.active .menu-item span,
            .sidebar.active .user-details {
                display: block;
            }
            
            .sidebar.active .menu-item {
                justify-content: flex-start;
                padding: 12px 20px;
                border-left: 3px solid transparent;
                border-right: none;
            }
            
            .sidebar.active .menu-item.active {
                border-left-color: #3498db;
                border-right: none;
            }
            
            .sidebar.active .menu-item i {
                margin-right: 12px;
            }
            
            .sidebar.active .user-info {
                justify-content: flex-start;
            }
            
            .sidebar.active .user-avatar {
                margin-right: 12px;
            }
        }
    </style>
</head>
<body>
    {{-- Sidebar --}}
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Member</h3>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-section">
                <h6 class="section-title">MAIN</h6>
                <ul>
                    <li>
                        <a href="{{ route('member.toko.index') }}" class="menu-item {{ request()->routeIs('member.toko.*') ? 'active' : '' }}">
                            <i class="fas fa-store"></i>
                            <span>Toko</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('member.produk.index') }}" class="menu-item {{ request()->routeIs('member.produk.*') ? 'active' : '' }}">
                            <i class="fas fa-box"></i>
                            <span>Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('member.gambarproduk.index') }}" class="menu-item {{ request()->routeIs('member.gambarproduk.*') ? 'active' : '' }}">
                            <i class="fas fa-image"></i>
                            <span>Gambar Produk</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="menu-section">
                <h6 class="section-title">MANAGEMENT</h6>
                <ul>
                    <li>
                        <a href="{{ route('switch') }}" class="menu-item {{ request()->routeIs('switch') ? 'active' : '' }}">
                            <i class="fas fa-right-left"></i>
                            <span>Switch Akun</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" 
                            class="menu-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-right-from-bracket"></i>
                            <span>Keluar</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="user-details">
                    <span class="user-name">Member</span>
                    <span class="user-role">System Member</span>
                </div>
            </div>
        </div>
    </div>

    <main class="main-content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script untuk toggle sidebar di mobile
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            
            // Function untuk toggle sidebar
            function toggleSidebar() {
                sidebar.classList.toggle('active');
            }
            
            // Event listener untuk toggle button (jika ada)
            const toggleButtons = document.querySelectorAll('.sidebar-toggle');
            toggleButtons.forEach(button => {
                button.addEventListener('click', toggleSidebar);
            });
            
            // Close sidebar ketika klik di luar pada mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && sidebar.classList.contains('active')) {
                        sidebar.classList.remove('active');
                    }
                }
            });
        });
    </script>
</body>
</html>