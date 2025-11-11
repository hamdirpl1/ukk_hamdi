<!DOCTYPE html>
<html lang="en">
<style>
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

/* Responsive Design */
@media (max-width: 992px) {
    .sidebar {
        width: 70px;
        overflow: hidden;
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
/* Navbar Formal */
.navbar {
    position: fixed;
    top: 0;
    left: var(--sidebar-width);
    right: 0;
    height: var(--navbar-height);
    background-color: #ffffff;
    border-bottom: 1px solid #e0e0e0;
    z-index: 999;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 25px;
    transition: all 0.3s;
}

.navbar-left {
    display: flex;
    align-items: center;
}

.breadcrumb {
    display: flex;
    align-items: center;
    margin: 0;
    padding: 0;
    list-style: none;
}

.breadcrumb-item {
    font-size: 14px;
    color: #7f8c8d;
}

.breadcrumb-item.active {
    color: #2c3e50;
    font-weight: 500;
}

.breadcrumb-divider {
    margin: 0 8px;
    color: #bdc3c7;
}

.navbar-right {
    display: flex;
    align-items: center;
    gap: 15px;
}

.nav-item {
    position: relative;
    padding: 8px;
    color: #7f8c8d;
    cursor: pointer;
    transition: color 0.2s ease;
}

.nav-item:hover {
    color: #2c3e50;
}

.notification-badge {
    position: absolute;
    top: 0;
    right: 0;
    background-color: #e74c3c;
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    font-size: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 5px 10px;
    border-radius: 6px;
    transition: background-color 0.2s ease;
}

.user-profile:hover {
    background-color: #f8f9fa;
}

.user-profile img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e0e0e0;
}

.user-profile span {
    font-size: 14px;
    color: #2c3e50;
    font-weight: 500;
}

.sidebar-toggle {
    background: none;
    border: none;
    color: #7f8c8d;
    font-size: 18px;
    padding: 8px;
    margin-right: 15px;
    cursor: pointer;
}

.sidebar-toggle:hover {
    color: #2c3e50;
}

/* Responsive Navbar */
@media (max-width: 992px) {
    .navbar {
        left: 70px;
    }
    
    .user-profile span {
        display: none;
    }
}

@media (max-width: 768px) {
    .navbar {
        left: 0;
    }
    
    .breadcrumb {
        display: none;
    }
    
    .nav-item span:not(.notification-badge) {
        display: none;
    }
}
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    {{-- Sidebar --}}
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Admin System</h3>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-section">
                <h6 class="section-title">MAIN</h6>
                <ul>
                    <li>
                        <a href="#" class="menu-item active">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item">
                            <i class="fas fa-chart-bar"></i>
                            <span>Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item">
                            <i class="fas fa-briefcase"></i>
                            <span>Projects</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="menu-section">
                <h6 class="section-title">MANAGEMENT</h6>
                <ul>
                    <li>
                        <a href="#" class="menu-item">
                            <i class="fas fa-users"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item">
                            <i class="fas fa-user-tie"></i>
                            <span>Employees</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item">
                            <i class="fas fa-boxes"></i>
                            <span>Inventory</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <span>Finance</span>
                        </a>
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
                    <span class="user-name">Administrator</span>
                    <span class="user-role">System Admin</span>
                </div>
            </div>
        </div>
    </div>

    <main class="flex-grow-1" id="main-content" style="margin-left: 260px; padding: 20px; height: 100vh; overflow-y: auto;">
    @yield('content')
  </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
