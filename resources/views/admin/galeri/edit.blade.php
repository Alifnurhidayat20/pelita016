@extends('layouts.admin')

@section('title', 'Edit Galeri - PELITA 016')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Edit Galeri</h1>
        <a href="{{ route('admin.galeri') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Judul Foto</label>
                <input type="text" name="judul" value="{{ $galeri->judul }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                <select name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <option value="kegiatan" {{ $galeri->kategori == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="bank_sampah" {{ $galeri->kategori == 'bank_sampah' ? 'selected' : '' }}>Bank Sampah</option>
                    <option value="sosial" {{ $galeri->kategori == 'sosial' ? 'selected' : '' }}>Sosial</option>
                    <option value="lingkungan" {{ $galeri->kategori == 'lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ $galeri->deskripsi }}</textarea>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Gambar Saat Ini</label>
                @if($galeri->gambar && file_exists(public_path('uploads/galeri/'.$galeri->gambar)))
                    <img src="{{ asset('uploads/galeri/'.$galeri->gambar) }}" class="w-32 h-32 object-cover rounded mb-2">
                @endif
                <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                    <i class="fas fa-save mr-2"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection