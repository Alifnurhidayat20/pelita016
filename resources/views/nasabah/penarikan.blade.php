@extends('layouts.app')

@section('title', 'Tarik Saldo - PELITA 016')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-yellow-500 to-orange-600 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Tarik Saldo</h1>
                <p class="text-white/80 text-sm">Tarik saldo tabungan sampah Anda</p>
            </div>
            
            <form action="{{ route('nasabah.penarikan.store') }}" method="POST" class="p-6">
                @csrf
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="mb-6 text-center">
                    <p class="text-gray-500">Saldo Saat Ini</p>
                    <p class="text-4xl font-bold text-green-600">Rp {{ number_format($nasabah->saldo, 0, ',', '.') }}</p>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Jumlah Penarikan (Rp)</label>
                    <input type="number" name="jumlah" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Minimal Rp 10.000" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Metode Penarikan</label>
                    <select name="metode_penarikan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option value="tunai">Tunai (Ambil di Kantor)</option>
                        <option value="transfer">Transfer Bank</option>
                    </select>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('nasabah.dashboard') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                        Batal
                    </a>
                    <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition">
                        <i class="fas fa-money-bill-wave mr-2"></i>Ajukan Penarikan
                    </button>
                </div>
            </form>
        </div>
        
        <div class="mt-6 bg-blue-50 rounded-xl p-4">
            <div class="flex items-start space-x-3">
                <i class="fas fa-info-circle text-blue-600 mt-1"></i>
                <div class="text-sm text-gray-700">
                    <p class="font-semibold">Informasi:</p>
                    <p>Penarikan akan diproses oleh admin dalam 1x24 jam. Minimal penarikan Rp 10.000.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection