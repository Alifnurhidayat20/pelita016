@extends('layouts.app')

@section('title', 'Dashboard Nasabah - PELITA 016')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl shadow-xl p-8 mb-8 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="text-white/90">Terus kumpulkan sampah dan raih manfaatnya!</p>
                </div>
                <div class="text-right">
                    <p class="text-sm opacity-90">No. Rekening</p>
                    <p class="text-xl font-mono font-bold">{{ $nasabah->no_rekening }}</p>
                </div>
            </div>
        </div>

        <!-- Saldo Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 hover-scale">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Saldo</p>
                    <p class="text-4xl font-bold text-green-600">Rp {{ number_format($saldoAktif, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 mt-2">Total Setoran: Rp {{ number_format($totalSetoran, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500">Total Penarikan: Rp {{ number_format($totalPenarikan, 0, ',', '.') }}</p>
                </div>
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-wallet text-green-600 text-4xl"></i>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <a href="{{ route('nasabah.setoran.form') }}" class="bg-white rounded-xl shadow-lg p-6 hover-scale flex items-center justify-between group">
                <div>
                    <i class="fas fa-trash-alt text-3xl text-green-600 mb-2 block"></i>
                    <h3 class="text-xl font-bold">Setor Sampah</h3>
                    <p class="text-gray-500 text-sm">Kumpulkan sampah dan dapatkan poin</p>
                </div>
                <i class="fas fa-arrow-right text-gray-400 group-hover:text-green-600 transition text-2xl"></i>
            </a>
            
            <a href="{{ route('nasabah.penarikan.form') }}" class="bg-white rounded-xl shadow-lg p-6 hover-scale flex items-center justify-between group">
                <div>
                    <i class="fas fa-money-bill-wave text-3xl text-yellow-600 mb-2 block"></i>
                    <h3 class="text-xl font-bold">Tarik Saldo</h3>
                    <p class="text-gray-500 text-sm">Tarik saldo tabungan sampah Anda</p>
                </div>
                <i class="fas fa-arrow-right text-gray-400 group-hover:text-yellow-600 transition text-2xl"></i>
            </a>
        </div>

        <!-- Recent Transactions -->
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Setoran Terbaru</h3>
                    <a href="{{ route('nasabah.riwayat') }}" class="text-green-600 text-sm">Lihat semua</a>
                </div>
                
                @if($setoranTerbaru->count() > 0)
                    <div class="space-y-3">
                        @foreach($setoranTerbaru as $setoran)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-semibold">{{ $setoran->hargaSampah->jenis_sampah ?? '-' }}</p>
                                <p class="text-sm text-gray-500">{{ $setoran->tanggal_setor->format('d/m/Y') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-green-600">+ Rp {{ number_format($setoran->total_harga, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500">{{ $setoran->berat }} kg</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Belum ada setoran</p>
                @endif
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Penarikan Terbaru</h3>
                    <a href="{{ route('nasabah.riwayat') }}" class="text-green-600 text-sm">Lihat semua</a>
                </div>
                
                @if($penarikanTerbaru->count() > 0)
                    <div class="space-y-3">
                        @foreach($penarikanTerbaru as $penarikan)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-semibold">Penarikan Saldo</p>
                                <p class="text-sm text-gray-500">{{ $penarikan->created_at->format('d/m/Y') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-red-600">- Rp {{ number_format($penarikan->jumlah, 0, ',', '.') }}</p>
                                <span class="text-xs px-2 py-1 rounded-full 
                                    @if($penarikan->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($penarikan->status == 'disetujui') bg-blue-100 text-blue-800
                                    @elseif($penarikan->status == 'selesai') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($penarikan->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Belum ada penarikan</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection