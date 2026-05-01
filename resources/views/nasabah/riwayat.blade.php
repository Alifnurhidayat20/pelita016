@extends('layouts.app')

@section('title', 'Riwayat Transaksi - PELITA 016')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Riwayat Transaksi</h1>
                <p class="text-white/80 text-sm">Semua riwayat setoran dan penarikan Anda</p>
            </div>
            
            <div class="p-6">
                <!-- Tab Navigation -->
                <div class="flex border-b mb-6">
                    <button class="tab-btn active px-4 py-2 text-green-600 border-b-2 border-green-600 font-semibold" data-tab="setoran">
                        Setoran Sampah
                    </button>
                    <button class="tab-btn px-4 py-2 text-gray-500 hover:text-green-600" data-tab="penarikan">
                        Penarikan Saldo
                    </button>
                </div>
                
                <!-- Tab Setoran -->
                <div id="tab-setoran" class="tab-content active">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Berat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($setorans as $setoran)
                                <tr>
                                    <td class="px-6 py-4 text-sm">{{ $setoran->kode_transaksi }}</td>
                                    <td class="px-6 py-4">{{ $setoran->hargaSampah->jenis_sampah ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $setoran->berat }} kg</td>
                                    <td class="px-6 py-4 text-green-600 font-semibold">+ Rp {{ number_format($setoran->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">{{ $setoran->tanggal_setor->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            @if($setoran->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($setoran->status == 'diterima') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ $setoran->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada riwayat setoran</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $setorans->links() }}
                    </div>
                </div>
                
                <!-- Tab Penarikan -->
                <div id="tab-penarikan" class="tab-content hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Metode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($penarikans as $penarikan)
                                <tr>
                                    <td class="px-6 py-4 text-sm">{{ $penarikan->kode_penarikan }}</td>
                                    <td class="px-6 py-4 text-red-600 font-semibold">- Rp {{ number_format($penarikan->jumlah, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">{{ $penarikan->metode_penarikan }}</td>
                                    <td class="px-6 py-4">{{ $penarikan->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            @if($penarikan->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($penarikan->status == 'disetujui') bg-blue-100 text-blue-800
                                            @elseif($penarikan->status == 'selesai') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ $penarikan->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada riwayat penarikan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $penarikans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Tab functionality
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const tab = btn.dataset.tab;
            
            tabBtns.forEach(b => {
                b.classList.remove('active', 'text-green-600', 'border-b-2', 'border-green-600');
                b.classList.add('text-gray-500');
            });
            btn.classList.remove('text-gray-500');
            btn.classList.add('active', 'text-green-600', 'border-b-2', 'border-green-600');
            
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            document.getElementById(`tab-${tab}`).classList.remove('hidden');
        });
    });
</script>
@endpush
@endsection