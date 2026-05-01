@extends('layouts.admin')

@section('title', 'Data Setoran - PELITA 016')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Data Setoran Sampah</h1>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table>
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nasabah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Sampah</th>
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
                    <td class="px-6 py-4">{{ $setoran->nasabah->user->name }}</td>
                    <td class="px-6 py-4">{{ $setoran->hargaSampah->jenis_sampah ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $setoran->berat }} kg</td>
                    <td class="px-6 py-4">Rp {{ number_format($setoran->total_harga, 0, ',', '.') }}</td>
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
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada data setoran</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $setorans->links() }}
        </div>
    </div>
</div>
@endsection