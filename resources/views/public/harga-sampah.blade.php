@extends('layouts.app')

@section('title', 'Harga Sampah - PELITA 016')

@section('content')
<div class="bg-white">
    <!-- Hero -->
    <div class="relative bg-gradient-to-r from-green-600 to-emerald-700 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">Daftar Harga Sampah</h1>
            <p class="text-xl text-white/90" data-aos="fade-up" data-aos-delay="100">Harga terbaru untuk setiap jenis sampah</p>
        </div>
    </div>

    <!-- Price List -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold gradient-text">Harga Berlaku Saat Ini</h2>
                <p class="text-gray-600 mt-4">Harga dapat berubah sewaktu-waktu</p>
            </div>
            
            @if($hargaSampah->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($hargaSampah as $item)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover-scale border border-gray-100" data-aos="flip-up">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-4 text-white">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold">{{ $item->jenis_sampah }}</h3>
                            <i class="fas fa-trash-alt text-2xl"></i>
                        </div>
                        <p class="text-sm opacity-90">{{ $item->kategori }}</p>
                    </div>
                    <div class="p-6">
                        <div class="text-center mb-4">
                            <p class="text-3xl font-bold text-green-600">Rp {{ number_format($item->harga_per_kg, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500">per {{ $item->satuan }}</p>
                        </div>
                        <p class="text-gray-600 text-sm">{{ $item->deskripsi ?: 'Sampah ' . $item->jenis_sampah . ' yang sudah dipilah' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-20">
                <i class="fas fa-tags text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-semibold text-gray-600">Belum Ada Data Harga</h3>
                <p class="text-gray-500">Harga sampah akan segera diupdate</p>
            </div>
            @endif
            
            <div class="mt-12 p-6 bg-yellow-50 rounded-xl text-center">
                <i class="fas fa-info-circle text-yellow-600 text-2xl mb-2"></i>
                <p class="text-gray-700">Harga di atas berlaku untuk sampah yang sudah dipilah dan bersih.</p>
                <p class="text-gray-600 text-sm mt-2">Untuk informasi lebih lanjut, hubungi petugas Bank Sampah.</p>
            </div>
        </div>
    </div>
</div>
@endsection