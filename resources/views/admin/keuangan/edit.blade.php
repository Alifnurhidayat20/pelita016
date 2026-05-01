@extends('layouts.admin')

@section('title', 'Edit Transaksi - PELITA 016')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Edit Transaksi Keuangan</h1>
        <a href="{{ route('admin.keuangan') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('admin.keuangan.update', $keuangan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Jenis Transaksi</label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="jenis" value="pemasukan" {{ $keuangan->jenis == 'pemasukan' ? 'checked' : '' }} class="mr-2" required> Pemasukan
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="jenis" value="pengeluaran" {{ $keuangan->jenis == 'pengeluaran' ? 'checked' : '' }} class="mr-2" required> Pengeluaran
                    </label>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                <select name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <option value="">Pilih Kategori</option>
                    <optgroup label="Pemasukan">
                        <option value="Setoran Sampah" {{ $keuangan->kategori == 'Setoran Sampah' ? 'selected' : '' }}>Setoran Sampah</option>
                        <option value="Donasi" {{ $keuangan->kategori == 'Donasi' ? 'selected' : '' }}>Donasi</option>
                        <option value="Bantuan Pemerintah" {{ $keuangan->kategori == 'Bantuan Pemerintah' ? 'selected' : '' }}>Bantuan Pemerintah</option>
                        <option value="Lainnya" {{ $keuangan->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </optgroup>
                    <optgroup label="Pengeluaran">
                        <option value="Operasional" {{ $keuangan->kategori == 'Operasional' ? 'selected' : '' }}>Operasional</option>
                        <option value="Penarikan Nasabah" {{ $keuangan->kategori == 'Penarikan Nasabah' ? 'selected' : '' }}>Penarikan Nasabah</option>
                        <option value="Kegiatan" {{ $keuangan->kategori == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="Peralatan" {{ $keuangan->kategori == 'Peralatan' ? 'selected' : '' }}>Peralatan</option>
                        <option value="Transportasi" {{ $keuangan->kategori == 'Transportasi' ? 'selected' : '' }}>Transportasi</option>
                        <option value="Lainnya" {{ $keuangan->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </optgroup>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Jumlah (Rp)</label>
                <input type="number" name="jumlah" value="{{ $keuangan->jumlah }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tanggal</label>
                <input type="date" name="tanggal" value="{{ $keuangan->tanggal->format('Y-m-d') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ $keuangan->deskripsi }}</textarea>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Bukti Saat Ini</label>
                @if($keuangan->bukti)
                    <img src="{{ asset('uploads/keuangan/'.$keuangan->bukti) }}" class="w-32 h-32 object-cover rounded mb-2">
                @endif
                <input type="file" name="bukti" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah bukti</p>
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