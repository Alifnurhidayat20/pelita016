@extends('layouts.admin')

@section('title', 'Harga Sampah - PELITA 016')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Harga Sampah</h1>
        <a href="{{ route('admin.harga-sampah.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            <i class="fas fa-plus mr-2"></i>Tambah Harga
        </a>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Sampah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga/Kg</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Satuan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($hargaSampahs as $item)
                <tr>
                    <td class="px-6 py-4 font-medium">{{ $item->jenis_sampah }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full 
                            @if($item->kategori == 'Organik') bg-green-100 text-green-800
                            @elseif($item->kategori == 'Non-Organik') bg-blue-100 text-blue-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ $item->kategori }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-green-600 font-semibold">Rp {{ number_format($item->harga_per_kg, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">{{ $item->satuan }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.harga-sampah.edit', $item->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.harga-sampah.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data harga sampah</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection