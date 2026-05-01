@extends('layouts.admin')

@section('title', 'Laporan - PELITA 016')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Generate Laporan</h1>
    
    <!-- Statistik Ringkas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Nasabah</p>
                    <p class="text-2xl font-bold">{{ $totalNasabah }}</p>
                </div>
                <i class="fas fa-users text-3xl text-green-600"></i>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Setoran</p>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalSetoran, 0, ',', '.') }}</p>
                </div>
                <i class="fas fa-chart-line text-3xl text-blue-600"></i>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Penarikan</p>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalPenarikan, 0, ',', '.') }}</p>
                </div>
                <i class="fas fa-money-bill-wave text-3xl text-yellow-600"></i>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Sampah</p>
                    <p class="text-2xl font-bold">{{ number_format($totalBerat, 0, ',', '.') }} kg</p>
                </div>
                <i class="fas fa-recycle text-3xl text-purple-600"></i>
            </div>
        </div>
    </div>
    
    <!-- Form Generate Laporan -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-bold mb-4">Export Laporan PDF</h2>
        
        <form action="{{ route('admin.laporan.generate') }}" method="POST" target="_blank">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Jenis Laporan</label>
                    <select name="jenis" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Pilih Laporan</option>
                        <option value="setoran">Laporan Setoran Sampah</option>
                        <option value="penarikan">Laporan Penarikan Saldo</option>
                        <option value="nasabah">Laporan Data Nasabah</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                    <i class="fas fa-file-pdf mr-2"></i>Export PDF
                </button>
            </div>
        </form>
    </div>
</div>
@endsection