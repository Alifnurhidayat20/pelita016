@extends('layouts.admin')

@section('title', 'Data Penarikan - PELITA 016')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Data Penarikan Saldo</h1>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table>
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nasabah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Metode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($penarikans as $penarikan)
                <tr>
                    <td class="px-6 py-4 text-sm">{{ $penarikan->kode_penarikan }}</td>
                    <td class="px-6 py-4">{{ $penarikan->nasabah->user->name }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($penarikan->jumlah, 0, ',', '.') }}</td>
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
                    <td class="px-6 py-4">
                        @if($penarikan->status == 'pending')
                            <button onclick="alert('Fitur verifikasi akan segera hadir')" class="bg-green-500 text-white px-3 py-1 rounded text-sm">
                                Proses
                            </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada data penarikan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $penarikans->links() }}
        </div>
    </div>
</div>
@endsection