@extends('layouts.admin')

@section('title', 'Edit Harga Sampah - PELITA 016')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Edit Harga Sampah</h1>
        <a href="{{ route('admin.harga-sampah') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('admin.harga-sampah.update', $hargaSampah->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Jenis Sampah</label>
                <input type="text" name="jenis_sampah" value="{{ $hargaSampah->jenis_sampah }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                <select name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <option value="Organik" {{ $hargaSampah->kategori == 'Organik' ? 'selected' : '' }}>Organik</option>
                    <option value="Non-Organik" {{ $hargaSampah->kategori == 'Non-Organik' ? 'selected' : '' }}>Non-Organik</option>
                    <option value="B3" {{ $hargaSampah->kategori == 'B3' ? 'selected' : '' }}>B3 (Berbahaya)</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Harga per Kg (Rp)</label>
                <input type="number" name="harga_per_kg" value="{{ $hargaSampah->harga_per_kg }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Satuan</label>
                <input type="text" name="satuan" value="{{ $hargaSampah->satuan }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ $hargaSampah->deskripsi }}</textarea>
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