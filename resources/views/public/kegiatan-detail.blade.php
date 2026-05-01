@extends('layouts.app')

@section('title', $kegiatan->judul . ' - PELITA 016')

@section('content')
<div class="bg-white py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="mb-8">
            <a href="/kegiatan" class="text-green-600 hover:text-green-700">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Kegiatan
            </a>
        </nav>
        
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            @if($kegiatan->gambar)
                <img src="{{ asset('uploads/kegiatan/'.$kegiatan->gambar) }}" alt="{{ $kegiatan->judul }}" class="w-full h-96 object-cover">
            @else
                <div class="w-full h-96 bg-gradient-to-r from-green-400 to-emerald-500 flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-white text-8xl"></i>
                </div>
            @endif
            
            <div class="p-8">
                <div class="flex justify-between items-start mb-4">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $kegiatan->judul }}</h1>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        @if($kegiatan->status == 'upcoming') bg-yellow-100 text-yellow-800
                        @elseif($kegiatan->status == 'ongoing') bg-green-100 text-green-800
                        @elseif($kegiatan->status == 'completed') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($kegiatan->status) }}
                    </span>
                </div>
                
                <div class="flex flex-wrap gap-4 mb-6 text-gray-600">
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt text-green-600 mr-2"></i>
                        <span>{{ $kegiatan->lokasi }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar text-green-600 mr-2"></i>
                        <span>{{ $kegiatan->tanggal_mulai->format('l, d M Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock text-green-600 mr-2"></i>
                        <span>{{ $kegiatan->tanggal_mulai->format('H:i') }} - {{ $kegiatan->tanggal_selesai->format('H:i') }}</span>
                    </div>
                </div>
                
                <div class="prose max-w-none">
                    <h3 class="text-xl font-semibold mb-3">Deskripsi Kegiatan</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $kegiatan->deskripsi }}</p>
                </div>
                
                @if($kegiatan->kuota)
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Kuota Peserta</span>
                        <span>{{ rand(10, $kegiatan->kuota) }}/{{ $kegiatan->kuota }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ (rand(10, $kegiatan->kuota) / $kegiatan->kuota) * 100 }}%"></div>
                    </div>
                </div>
                @endif
                
                @if($kegiatan->status == 'upcoming')
                <div class="mt-8">
                    <button class="btn-gradient text-white px-8 py-3 rounded-full">
                        <i class="fas fa-user-plus mr-2"></i>Daftar Kegiatan
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection