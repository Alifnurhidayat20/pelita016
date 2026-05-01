@extends('layouts.app')

@section('title', 'Setor Sampah - PELITA 016')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Setor Sampah</h1>
                <p class="text-white/80 text-sm">Isi form di bawah untuk melakukan setoran sampah</p>
            </div>
            
            <form action="{{ route('nasabah.setoran.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Jenis Sampah</label>
                    <select name="harga_sampah_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Pilih Jenis Sampah</option>
                        @foreach($hargaSampah as $item)
                            <option value="{{ $item->id }}">{{ $item->jenis_sampah }} - Rp {{ number_format($item->harga_per_kg, 0, ',', '.') }}/kg</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Berat (kg)</label>
                    <input type="number" name="berat" step="0.1" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Contoh: 2.5" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Tanggal Setor</label>
                    <input type="date" name="tanggal_setor" value="{{ date('Y-m-d') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Bukti Foto (Opsional)</label>
                    <input type="file" name="bukti_foto" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    <p class="text-xs text-gray-500 mt-1">Upload foto sampah yang akan disetor (max 2MB)</p>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('nasabah.dashboard') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                        Batal
                    </a>
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Setoran
                    </button>
                </div>
            </form>
        </div>
        
        <div class="mt-6 bg-yellow-50 rounded-xl p-4">
            <div class="flex items-start space-x-3">
                <i class="fas fa-info-circle text-yellow-600 mt-1"></i>
                <div class="text-sm text-gray-700">
                    <p class="font-semibold">Informasi:</p>
                    <p>Setoran akan diverifikasi oleh admin terlebih dahulu. Saldo akan ditambahkan setelah setoran disetujui.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection