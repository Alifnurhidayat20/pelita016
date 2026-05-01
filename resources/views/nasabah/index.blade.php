@extends('layouts.admin')

@section('title', 'Data Nasabah - PELITA 016')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Data Nasabah</h1>
        <button onclick="alert('Fitur tambah nasabah akan segera hadir')" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            <i class="fas fa-plus mr-2"></i>Tambah Nasabah
        </button>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table>
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Rekening</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Telepon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Saldo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($nasabahs as $nasabah)
                <tr>
                    <td class="px-6 py-4 text-sm">{{ $nasabah->no_rekening }}</td>
                    <td class="px-6 py-4">{{ $nasabah->user->name }}</td>
                    <td class="px-6 py-4">{{ $nasabah->user->email }}</td>
                    <td class="px-6 py-4">{{ $nasabah->user->no_telepon }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($nasabah->saldo, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full {{ $nasabah->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $nasabah->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data nasabah</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $nasabahs->links() }}
        </div>
    </div>
</div>
@endsection