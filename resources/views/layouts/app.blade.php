<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PELITA 016 - Karang Taruna & Bank Sampah')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: translateY(-5px);
        }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    
    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-recycle text-white text-xl"></i>
                        </div>
                        <span class="font-bold text-xl">
                            <span class="text-green-600">PELITA</span>
                            <span class="text-gray-800">016</span>
                        </span>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-green-600 transition">Home</a>
                    <a href="/profil" class="text-gray-700 hover:text-green-600 transition">Profil</a>
                    <a href="/kegiatan" class="text-gray-700 hover:text-green-600 transition">Kegiatan</a>
                    <a href="/galeri" class="text-gray-700 hover:text-green-600 transition">Galeri</a>
                    <a href="/harga-sampah" class="text-gray-700 hover:text-green-600 transition">Harga Sampah</a>
                    <a href="/kontak" class="text-gray-700 hover:text-green-600 transition">Kontak</a>
                    
                    @guest
                        <a href="/login" class="btn-gradient text-white px-5 py-2 rounded-full">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                    @else
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-green-600">
                                <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl hidden group-hover:block">
                                @if(Auth::user()->isAdmin())
                                    <a href="/admin/dashboard" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                    </a>
                                @else
                                    <a href="/nasabah/dashboard" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                    </a>
                                @endif
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
                
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-700">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="/" class="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">Home</a>
                <a href="/profil" class="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">Profil</a>
                <a href="/kegiatan" class="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">Kegiatan</a>
                <a href="/galeri" class="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">Galeri</a>
                <a href="/harga-sampah" class="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">Harga Sampah</a>
                <a href="/kontak" class="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">Kontak</a>
                @guest
                    <a href="/login" class="block px-3 py-2 text-green-600 font-semibold">Login</a>
                @else
                    <a href="/dashboard" class="block px-3 py-2 text-green-600 font-semibold">Dashboard</a>
                @endguest
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-recycle text-white text-xl"></i>
                        </div>
                        <span class="font-bold text-xl">PELITA 016</span>
                    </div>
                    <p class="text-gray-400">Karang Taruna & Bank Sampah peduli lingkungan untuk masa depan yang lebih baik.</p>
                </div>
                
                <div>
                    <h4 class="font-semibold text-lg mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-400 hover:text-green-400">Home</a></li>
                        <li><a href="/profil" class="text-gray-400 hover:text-green-400">Profil</a></li>
                        <li><a href="/kegiatan" class="text-gray-400 hover:text-green-400">Kegiatan</a></li>
                        <li><a href="/kontak" class="text-gray-400 hover:text-green-400">Kontak</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold text-lg mb-4">Bank Sampah</h4>
                    <ul class="space-y-2">
                        <li><a href="/harga-sampah" class="text-gray-400 hover:text-green-400">Harga Sampah</a></li>
                        <li><a href="/login" class="text-gray-400 hover:text-green-400">Login Nasabah</a></li>
                        <li><a href="/register" class="text-gray-400 hover:text-green-400">Daftar Nasabah</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold text-lg mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Jakarta, Indonesia</li>
                        <li><i class="fas fa-phone mr-2"></i> +62 812 3456 7890</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@pelita016.com</li>
                    </ul>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-green-400"><i class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-green-400"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-green-400"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-green-400"><i class="fab fa-youtube text-xl"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 PELITA 016. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if(mobileMenuButton) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>