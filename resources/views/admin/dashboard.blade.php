@extends('layouts.admin')

@section('title', 'Admin Dashboard - PELITA 016')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Nasabah</p>
                    <p class="text-3xl font-bold">{{ $totalNasabah }}</p>
                </div>
                <i class="fas fa-users text-3xl text-green-600"></i>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Setoran</p>
                    <p class="text-3xl font-bold">Rp {{ number_format($totalSetoran, 0, ',', '.') }}</p>
                </div>
                <i class="fas fa-chart-line text-3xl text-blue-600"></i>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Penarikan</p>
                    <p class="text-3xl font-bold">Rp {{ number_format($totalPenarikan, 0, ',', '.') }}</p>
                </div>
                <i class="fas fa-money-bill-wave text-3xl text-yellow-600"></i>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Sampah</p>
                    <p class="text-3xl font-bold">{{ number_format($totalBeratSampah, 0, ',', '.') }} kg</p>
                </div>
                <i class="fas fa-recycle text-3xl text-purple-600"></i>
            </div>
        </div>
    </div>
    
    <!-- Additional Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg shadow p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Setoran Hari Ini</p>
                    <p class="text-4xl font-bold">{{ $setoranHariIni }}</p>
                    <p class="text-sm opacity-90 mt-2">Transaksi</p>
                </div>
                <i class="fas fa-calendar-day text-5xl opacity-50"></i>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-red-500 to-pink-600 rounded-lg shadow p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90">Pending Penarikan</p>
                    <p class="text-4xl font-bold">{{ $pendingPenarikan }}</p>
                    <p class="text-sm opacity-90 mt-2">Menunggu Verifikasi</p>
                </div>
                <i class="fas fa-clock text-5xl opacity-50"></i>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions - TANPA admin.nasabah.create -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold mb-4">Menu Cepat</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <a href="{{ url('/admin/nasabah') }}" class="bg-green-50 p-4 rounded-lg text-center hover:bg-green-100 transition">
                <i class="fas fa-users text-green-600 text-2xl mb-2 block"></i>
                <span class="text-sm">Kelola Nasabah</span>
            </a>
            <a href="{{ url('/admin/setoran') }}" class="bg-blue-50 p-4 rounded-lg text-center hover:bg-blue-100 transition">
                <i class="fas fa-check-circle text-blue-600 text-2xl mb-2 block"></i>
                <span class="text-sm">Verifikasi Setoran</span>
            </a>
            <a href="{{ url('/admin/penarikan') }}" class="bg-yellow-50 p-4 rounded-lg text-center hover:bg-yellow-100 transition">
                <i class="fas fa-money-bill-wave text-yellow-600 text-2xl mb-2 block"></i>
                <span class="text-sm">Verifikasi Penarikan</span>
            </a>
        </div>
    </div>
</div>
@endsection