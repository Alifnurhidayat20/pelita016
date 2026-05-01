@extends('layouts.admin')

@section('title', 'Kelola Galeri - PELITA 016')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Kelola Galeri</h1>
        <a href="{{ route('admin.galeri.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            <i class="fas fa-plus mr-2"></i>Tambah Galeri
        </a>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($galeris as $item)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($item->gambar && file_exists(public_path('uploads/galeri/'.$item->gambar)))
                <img src="{{ asset('uploads/galeri/'.$item->gambar) }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                </div>
            @endif
            <div class="p-4">
                <h3 class="font-bold text-lg">{{ $item->judul }}</h3>
                <p class="text-gray-500 text-sm">{{ $item->kategori }} • {{ $item->tanggal_unggah->format('d/m/Y') }}</p>
                <p class="text-gray-600 text-sm mt-2">{{ Str::limit($item->deskripsi, 100) }}</p>
                <div class="flex justify-end space-x-2 mt-4">
                    <a href="{{ route('admin.galeri.edit', $item->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus foto ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12">
            <i class="fas fa-images text-gray-300 text-6xl mb-4"></i>
            <p class="text-gray-500">Belum ada foto di galeri</p>
        </div>
        @endforelse
    </div>
    
    <div class="mt-6">
        {{ $galeris->links() }}
    </div>
</div>
@endsection