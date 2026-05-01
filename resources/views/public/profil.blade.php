@extends('layouts.app')

@section('title', 'Profil - PELITA 016')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-green-600 to-emerald-700 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">Profil PELITA 016</h1>
            <p class="text-xl text-white/90" data-aos="fade-up" data-aos-delay="100">Karang Taruna & Bank Sampah - Peduli Lingkungan, Sejahtera Bersama</p>
        </div>
    </div>

    <!-- Visi Misi -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12">
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-8 rounded-2xl" data-aos="fade-right">
                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-eye text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Visi</h3>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Menjadi organisasi kepemudaan dan bank sampah yang unggul dalam pemberdayaan masyarakat dan pelestarian lingkungan hidup di Indonesia.
                    </p>
                </div>
                
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-8 rounded-2xl" data-aos="fade-left">
                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-bullseye text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Misi</h3>
                    <ul class="space-y-3 text-gray-700">
                        <li><i class="fas fa-check-circle text-green-600 mr-2"></i> Meningkatkan kesadaran masyarakat tentang pentingnya pengelolaan sampah</li>
                        <li><i class="fas fa-check-circle text-green-600 mr-2"></i> Memberdayakan pemuda melalui kegiatan positif dan produktif</li>
                        <li><i class="fas fa-check-circle text-green-600 mr-2"></i> Menciptakan ekonomi sirkular melalui bank sampah</li>
                        <li><i class="fas fa-check-circle text-green-600 mr-2"></i> Membangun kemandirian ekonomi masyarakat</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Sejarah -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3" alt="Sejarah" class="rounded-2xl shadow-lg w-full">
                </div>
                <div data-aos="fade-left">
                    <h2 class="text-3xl font-bold mb-6 gradient-text">Sejarah Berdirinya</h2>
                    <p class="text-gray-700 mb-4 leading-relaxed">
                        PELITA 016 didirikan pada tahun 2016 oleh sekelompok pemuda yang peduli terhadap lingkungan dan sosial kemasyarakatan. Berawal dari kegiatan rutin membersihkan lingkungan, terbentuklah Karang Taruna yang kemudian menginisiasi program Bank Sampah.
                    </p>
                    <p class="text-gray-700 mb-4 leading-relaxed">
                        Seiring berjalannya waktu, PELITA 016 terus berkembang dan kini memiliki lebih dari 500 nasabah aktif yang tersebar di berbagai wilayah. Program Bank Sampah kami telah berhasil mengelola lebih dari 50 ton sampah dan menciptakan nilai ekonomi bagi masyarakat.
                    </p>
                    <div class="flex items-center mt-6">
                        <div class="flex -space-x-2">
                            <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white text-sm">KT</div>
                            <div class="w-10 h-10 bg-emerald-600 rounded-full flex items-center justify-center text-white text-sm">BS</div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">8 Tahun Berdedikasi untuk Lingkungan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Struktur Organisasi -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold gradient-text mb-4">Struktur Organisasi</h2>
                <p class="text-gray-600">Pengurus PELITA 016 Periode 2024-2027</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center" data-aos="flip-up">
                    <div class="w-32 h-32 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-tie text-white text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold">Ahmad Rizal</h3>
                    <p class="text-green-600">Ketua Karang Taruna</p>
                </div>
                
                <div class="text-center" data-aos="flip-up" data-aos-delay="100">
                    <div class="w-32 h-32 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-line text-white text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold">Siti Nurjanah</h3>
                    <p class="text-green-600">Ketua Bank Sampah</p>
                </div>
                
                <div class="text-center" data-aos="flip-up" data-aos-delay="200">
                    <div class="w-32 h-32 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-alt text-white text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold">Budi Santoso</h3>
                    <p class="text-green-600">Sekretaris</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection