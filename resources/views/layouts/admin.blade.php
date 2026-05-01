<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - PELITA 016')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .sidebar {
            background: linear-gradient(180deg, #065f46 0%, #022c22 100%);
        }
        
        .sidebar-nav a {
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 8px;
            margin: 4px 0;
        }
        
        .sidebar-nav a:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-nav a.active {
            background: rgba(255, 255, 255, 0.15);
            border-left: 3px solid #22c55e;
        }
        
        .main-content {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        }
        
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(34, 197, 94, 0.3);
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        
        <!-- ==================== SIDEBAR ==================== -->
        <div class="sidebar w-72 flex-shrink-0 text-white shadow-2xl z-20 overflow-y-auto">
            <!-- Logo Area -->
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-recycle text-white text-2xl"></i>
                    </div>
                    <div>
                        <span class="font-bold text-xl tracking-wide">PELITA 016</span>
                        <p class="text-xs text-green-300 mt-1">Admin Panel</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="p-4 sidebar-nav">
                <div class="text-xs text-green-300 uppercase tracking-wider px-4 py-2 mt-2">MAIN MENU</div>
                
                <!-- Dashboard -->
                <a href="/admin/dashboard" class="hover:bg-white/10 transition">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span>Dashboard</span>
                </a>
                
                <!-- Data Nasabah -->
                <a href="/admin/nasabah" class="hover:bg-white/10 transition">
                    <i class="fas fa-users w-5"></i>
                    <span>Data Nasabah</span>
                </a>
                
                <!-- Setoran Sampah -->
                <a href="/admin/setoran" class="hover:bg-white/10 transition">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Setoran Sampah</span>
                </a>
                
                <!-- Penarikan Saldo -->
                <a href="/admin/penarikan" class="hover:bg-white/10 transition">
                    <i class="fas fa-money-bill-wave w-5"></i>
                    <span>Penarikan Saldo</span>
                </a>
                
                <div class="text-xs text-green-300 uppercase tracking-wider px-4 py-2 mt-4">MANAJEMEN</div>
                
                <!-- Harga Sampah -->
                <a href="/admin/harga-sampah" class="hover:bg-white/10 transition">
                    <i class="fas fa-tags w-5"></i>
                    <span>Harga Sampah</span>
                </a>
                
                <!-- Kegiatan -->
                <a href="/admin/kegiatan" class="hover:bg-white/10 transition">
                    <i class="fas fa-calendar-alt w-5"></i>
                    <span>Kegiatan</span>
                </a>

                <!-- Galeri -->
                <a href="/admin/galeri" class="hover:bg-white/10 transition">
                    <i class="fas fa-images w-5"></i>
                    <span>Galeri</span>
                </a>

                <!-- Laporan -->
                <a href="/admin/laporan" class="hover:bg-white/10 transition">
                    <i class="fas fa-file-pdf w-5"></i>
                    <span>Laporan</span>
                </a>
                </nav>
                <!-- Keuangan -->
                <a href="/admin/keuangan" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition">
                    <i class="fas fa-money-bill-wave w-5"></i>
                    <span>Keuangan</span>
                </a>
            
            <!-- Logout Button -->
            <div class="absolute bottom-0 left-0 w-72 p-6 border-t border-white/10 bg-green-900/50">
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 text-white/80 hover:text-white w-full hover:bg-white/10 px-4 py-3 rounded-lg transition">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
        <!-- ==================== END SIDEBAR ==================== -->
        
        <!-- ==================== MAIN CONTENT ==================== -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Top Navbar -->
            <div class="bg-white shadow-lg sticky top-0 z-10">
                <div class="flex justify-between items-center px-8 py-4">
                    <!-- Page Title -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-sm text-gray-500 mt-1">@yield('page-subtitle', 'Selamat datang di panel admin PELITA 016')</p>
                    </div>
                    
                    <!-- User Menu -->
                    <div class="flex items-center space-x-6">
                        <!-- Notification Bell -->
                        <button class="relative text-gray-500 hover:text-gray-700 transition">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute -top-1 -right-2 w-4 h-4 bg-red-500 rounded-full text-white text-xs flex items-center justify-center">3</span>
                        </button>
                        
                        <!-- User Dropdown -->
                        <div class="relative group">
                            <button class="flex items-center space-x-3 focus:outline-none">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="text-left">
                                    <p class="font-semibold text-gray-800 text-sm">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">Administrator</p>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-2xl hidden group-hover:block transition-all duration-300 z-50">
                                <div class="p-3 border-b border-gray-100">
                                    <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="p-2">
                                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                                        <i class="fas fa-user w-4"></i>
                                        <span class="text-sm">Profile</span>
                                    </a>
                                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                                        <i class="fas fa-cog w-4"></i>
                                        <span class="text-sm">Pengaturan</span>
                                    </a>
                                </div>
                                <div class="border-t border-gray-100 p-2">
                                    <form method="POST" action="/logout">
                                        @csrf
                                        <button type="submit" class="flex items-center space-x-3 px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition w-full">
                                            <i class="fas fa-sign-out-alt w-4"></i>
                                            <span class="text-sm">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto main-content">
                <div class="p-8">
                    @yield('content')
                </div>
            </div>
            
        </div>
        <!-- ==================== END MAIN CONTENT ==================== -->
        
    </div>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
        
        // Highlight active menu based on current URL
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuLinks = document.querySelectorAll('.sidebar-nav a');
            
            menuLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href && href !== '#' && href !== 'javascript:void(0)') {
                    if (currentPath === href || (currentPath.startsWith(href) && href !== '/admin/dashboard')) {
                        link.classList.add('active');
                    } else if (href === '/admin/dashboard' && currentPath === '/admin/dashboard') {
                        link.classList.add('active');
                    }
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>