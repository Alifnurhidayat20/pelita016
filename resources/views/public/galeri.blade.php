@extends('layouts.app')

@section('title', 'Galeri - PELITA 016')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-green-600 to-emerald-700 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">Galeri Kegiatan</h1>
            <p class="text-xl text-white/90" data-aos="fade-up" data-aos-delay="100">Dokumentasi aktivitas dan program PELITA 016</p>
        </div>
    </div>

    <!-- Gallery Filter -->
    <div class="py-10 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-4">
                <button class="filter-btn active px-6 py-2 rounded-full bg-green-600 text-white">Semua</button>
                <button class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-green-600 hover:text-white transition">Kegiatan</button>
                <button class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-green-600 hover:text-white transition">Bank Sampah</button>
                <button class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-green-600 hover:text-white transition">Sosial</button>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($galeri->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($galeri as $item)
                    <div class="group relative overflow-hidden rounded-xl shadow-lg hover-scale gallery-item" data-category="{{ $item->kategori }}" data-aos="zoom-in">
                        @if($item->gambar && file_exists(public_path('uploads/galeri/'.$item->gambar)))
                            <img src="{{ asset('uploads/galeri/'.$item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-64 object-cover transition transform duration-500 group-hover:scale-110">
                        @else
                            <div class="w-full h-64 bg-gradient-to-r from-green-400 to-emerald-500 flex items-center justify-center">
                                <i class="fas fa-image text-white text-6xl"></i>
                            </div>
                        @endif
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end">
                            <div class="p-6 text-white">
                                <h3 class="text-xl font-bold mb-1">{{ $item->judul }}</h3>
                                <p class="text-sm text-white/80">{{ $item->tanggal_unggah->format('d M Y') }}</p>
                                <p class="text-sm mt-2">{{ Str::limit($item->deskripsi, 100) }}</p>
                            </div>
                        </div>
                        
                        <!-- Category Badge -->
                        <span class="absolute top-4 right-4 px-3 py-1 bg-white/90 text-green-600 text-xs rounded-full font-semibold">
                            {{ ucfirst($item->kategori) }}
                        </span>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-12">
                    {{ $galeri->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-2xl font-semibold text-gray-600 mb-2">Belum Ada Galeri</h3>
                    <p class="text-gray-500">Belum ada foto kegiatan yang diunggah.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.textContent.toLowerCase();
            
            filterBtns.forEach(b => {
                b.classList.remove('active', 'bg-green-600', 'text-white');
                b.classList.add('bg-gray-200', 'text-gray-700');
            });
            btn.classList.remove('bg-gray-200', 'text-gray-700');
            btn.classList.add('active', 'bg-green-600', 'text-white');
            
            galleryItems.forEach(item => {
                if(filter === 'semua' || item.dataset.category === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush
@endsection