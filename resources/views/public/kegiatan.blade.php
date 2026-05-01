@extends('layouts.app')

@section('title', 'Kegiatan - PELITA 016')

@section('content')
<div class="bg-white">
    <!-- Hero -->
    <div class="relative bg-gradient-to-r from-green-600 to-emerald-700 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">Kegiatan Kami</h1>
            <p class="text-xl text-white/90" data-aos="fade-up" data-aos-delay="100">Berbagai kegiatan positif untuk lingkungan dan masyarakat</p>
        </div>
    </div>

    <!-- Filter -->
    <div class="py-10 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-4">
                <button class="filter-btn active px-6 py-2 rounded-full bg-green-600 text-white">Semua</button>
                <button class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-green-600 hover:text-white transition">Upcoming</button>
                <button class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-green-600 hover:text-white transition">Ongoing</button>
                <button class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-green-600 hover:text-white transition">Completed</button>
            </div>
        </div>
    </div>

    <!-- Kegiatan List -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($kegiatan as $item)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover-scale kegiatan-item" data-status="{{ $item->status }}" data-aos="zoom-in">
                    @if($item->gambar)
                        <img src="{{ asset('uploads/kegiatan/'.$item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-56 object-cover">
                    @else
                        <div class="w-full h-56 bg-gradient-to-r from-green-400 to-emerald-500 flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-white text-6xl"></i>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="px-3 py-1 bg-{{ $item->status == 'upcoming' ? 'yellow' : ($item->status == 'ongoing' ? 'green' : 'gray') }}-100 text-{{ $item->status == 'upcoming' ? 'yellow' : ($item->status == 'ongoing' ? 'green' : 'gray') }}-800 text-xs rounded-full">
                                {{ ucfirst($item->status) }}
                            </span>
                            <span class="text-sm text-gray-500">
                                <i class="far fa-calendar mr-1"></i> {{ $item->tanggal_mulai->format('d M Y') }}
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold mb-2">{{ $item->judul }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($item->deskripsi, 100) }}</p>
                        
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>{{ $item->lokasi }}</span>
                        </div>
                        
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="far fa-clock mr-2"></i>
                            <span>{{ $item->tanggal_mulai->format('H:i') }} - {{ $item->tanggal_selesai->format('H:i') }}</span>
                        </div>
                        
                        @if($item->kuota)
                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span>Kuota</span>
                                <span>{{ rand(10, $item->kuota) }}/{{ $item->kuota }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ (rand(10, $item->kuota) / $item->kuota) * 100 }}%"></div>
                            </div>
                        </div>
                        @endif
                        
                        <a href="/kegiatan/{{ $item->id }}" class="inline-block btn-gradient text-white px-6 py-2 rounded-full text-sm">
                            Detail Kegiatan <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-12">
                {{ $kegiatan->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const kegiatanItems = document.querySelectorAll('.kegiatan-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.textContent.toLowerCase();
            
            filterBtns.forEach(b => b.classList.remove('active', 'bg-green-600', 'text-white'));
            filterBtns.forEach(b => b.classList.add('bg-gray-200', 'text-gray-700'));
            btn.classList.remove('bg-gray-200', 'text-gray-700');
            btn.classList.add('active', 'bg-green-600', 'text-white');
            
            kegiatanItems.forEach(item => {
                if(filter === 'semua' || item.dataset.status === filter) {
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