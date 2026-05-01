@extends('layouts.admin')

@section('title', 'Tambah Transaksi - PELITA 016')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Tambah Transaksi Keuangan</h1>
        <a href="{{ route('admin.keuangan') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('admin.keuangan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Jenis Transaksi</label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="jenis" value="pemasukan" class="mr-2" required> Pemasukan
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="jenis" value="pengeluaran" class="mr-2" required> Pengeluaran
                    </label>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                <select name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <option value="">Pilih Kategori</option>
                    <optgroup label="Pemasukan">
                        <option value="Setoran Sampah">Setoran Sampah</option>
                        <option value="Donasi">Donasi</option>
                        <option value="Bantuan Pemerintah">Bantuan Pemerintah</option>
                        <option value="Lainnya">Lainnya</option>
                    </optgroup>
                    <optgroup label="Pengeluaran">
                        <option value="Operasional">Operasional</option>
                        <option value="Penarikan Nasabah">Penarikan Nasabah</option>
                        <option value="Kegiatan">Kegiatan</option>
                        <option value="Peralatan">Peralatan</option>
                        <option value="Transportasi">Transportasi</option>
                        <option value="Lainnya">Lainnya</option>
                    </optgroup>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Jumlah (Rp)</label>
                <input type="number" name="jumlah" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="0" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tanggal</label>
                <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Keterangan transaksi..."></textarea>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Bukti/Foto (Opsional)</label>
                <input type="file" name="bukti" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (Max 2MB)</p>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection