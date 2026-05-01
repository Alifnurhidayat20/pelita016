@extends('layouts.app')

@section('title', 'Home - PELITA 016')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-green-600/90 to-emerald-700/90 z-10"></div>
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3')] bg-cover bg-center"></div>
    
    <div class="relative z-20 text-center text-white px-4">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 animate__animated animate__fadeInUp">
            PELITA 016
        </h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto animate__animated animate__fadeInUp animate__delay-1s">
            Karang Taruna & Bank Sampah - Bersama Kita Jaga Bumi untuk Generasi Mendatang
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center animate__animated animate__fadeInUp animate__delay-2s">
            <a href="/register" class="bg-white text-green-600 px-8 py-3 rounded-full font-semibold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-user-plus mr-2"></i>Daftar Nasabah
            </a>
            <a href="/harga-sampah" class="border-2 border-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-green-600 transition">
                <i class="fas fa-chart-line mr-2"></i>Lihat Harga Sampah
            </a>
        </div>
    </div>
    
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
        <i class="fas fa-chevron-down text-white text-2xl"></i>
    </div>
</section>

<!-- Statistik Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-6 hover-scale" data-aos="fade-up">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-3xl text-green-600"></i>
                </div>
                <h3 class="text-4xl font-bold text-gray-800">{{ $statistik['total_nasabah'] }}</h3>
                <p class="text-gray-600 mt-2">Total Nasabah Aktif</p>
            </div>
            
            <div class="text-center p-6 hover-scale" data-aos="fade-up" data-aos-delay="100">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-weight-hanging text-3xl text-green-600"></i>
                </div>
                <h3 class="text-4xl font-bold text-gray-800">{{ number_format($statistik['total_setoran'], 0, ',', '.') }} kg</h3>
                <p class="text-gray-600 mt-2">Total Sampah Terkumpul</p>
            </div>
            
            <div class="text-center p-6 hover-scale" data-aos="fade-up" data-aos-delay="200">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-3xl text-green-600"></i>
                </div>
                <h3 class="text-4xl font-bold text-gray-800">{{ $statistik['total_sampah_terkumpul'] }}</h3>
                <p class="text-gray-600 mt-2">Total Transaksi</p>
            </div>
        </div>
    </div>
</section>

<!-- Layanan Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold gradient-text">Layanan Kami</h2>
            <p class="text-gray-600 mt-4">Berbagai layanan untuk kesejahteraan lingkungan dan masyarakat</p>
        </div>
        
        <div class="grid md:grid-cols-4 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-lg hover-scale" data-aos="flip-left">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-recycle text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Bank Sampah</h3>
                <p class="text-gray-600">Mengelola sampah menjadi nilai ekonomis bagi masyarakat</p>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-lg hover-scale" data-aos="flip-left" data-aos-delay="100">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-hand-holding-heart text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Kegiatan Sosial</h3>
                <p class="text-gray-600">Program sosial untuk memberdayakan masyarakat</p>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-lg hover-scale" data-aos="flip-left" data-aos-delay="200">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Edukasi Lingkungan</h3>
                <p class="text-gray-600">Pendidikan peduli lingkungan untuk semua umur</p>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-lg hover-scale" data-aos="flip-left" data-aos-delay="300">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Pengelolaan Sampah</h3>
                <p class="text-gray-600">Solusi pengelolaan sampah yang berkelanjutan</p>
            </div>
        </div>
    </div>
</section>

<!-- Kegiatan Terbaru -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold gradient-text">Kegiatan Terbaru</h2>
            <p class="text-gray-600 mt-4">Aksi nyata kami dalam membangun lingkungan yang lebih baik</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($kegiatanTerbaru as $kegiatan)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover-scale" data-aos="zoom-in">
                @if($kegiatan->gambar)
                    <img src="{{ asset('uploads/kegiatan/'.$kegiatan->gambar) }}" alt="{{ $kegiatan->judul }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gradient-to-r from-green-400 to-emerald-500 flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-white text-5xl"></i>
                    </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">{{ $kegiatan->judul }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($kegiatan->deskripsi, 100) }}</p>
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>{{ $kegiatan->lokasi }}</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>{{ $kegiatan->tanggal_mulai->format('d M Y') }}</span>
                    </div>
                    <a href="/kegiatan/{{ $kegiatan->id }}" class="text-green-600 font-semibold hover:text-green-700">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="/kegiatan" class="btn-gradient text-white px-8 py-3 rounded-full inline-block">
                Lihat Semua Kegiatan <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Galeri -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold gradient-text">Galeri Aktivitas</h2>
            <p class="text-gray-600 mt-4">Dokumentasi kegiatan kami dalam melestarikan lingkungan</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($galeriTerbaru as $galeri)
            <div class="relative group overflow-hidden rounded-xl" data-aos="fade-up">
                <img src="{{ asset('uploads/galeri/'.$galeri->gambar) }}" alt="{{ $galeri->judul }}" class="w-full h-64 object-cover transition transform group-hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                    <div class="text-center text-white">
                        <h3 class="text-xl font-bold">{{ $galeri->judul }}</h3>
                        <p class="text-sm">{{ $galeri->tanggal_unggah->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="/galeri" class="btn-gradient text-white px-8 py-3 rounded-full inline-block">
                Lihat Galeri Lengkap <i class="fas fa-images ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-green-600 to-emerald-700">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4" data-aos="fade-up">
            Bergabung Menjadi Nasabah Bank Sampah
        </h2>
        <p class="text-white text-lg mb-8" data-aos="fade-up" data-aos-delay="100">
            Daftar sekarang dan mulai mengumpulkan sampah untuk ditukar menjadi tabungan
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="200">
            <a href="/register" class="bg-white text-green-600 px-8 py-3 rounded-full font-semibold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
            </a>
            <a href="/kontak" class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-green-600 transition">
                <i class="fas fa-phone-alt mr-2"></i>Hubungi Kami
            </a>
        </div>
    </div>
</section>
@endsection