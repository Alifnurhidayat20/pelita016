<?php

namespace App\Http\Controllers;

use App\Models\HargaSampah;
use Illuminate\Http\Request;

class HargaSampahController extends Controller
{
    public function index()
    {
        $hargaSampahs = HargaSampah::latest()->get();
        return view('admin.harga-sampah.index', compact('hargaSampahs'));
    }

    public function create()
    {
        return view('admin.harga-sampah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_sampah' => 'required|string|max:255',
            'kategori' => 'required|string',
            'harga_per_kg' => 'required|numeric|min:0',
            'satuan' => 'required|string'
        ]);

        HargaSampah::create($request->all());

        return redirect()->route('admin.harga-sampah')->with('success', 'Harga sampah berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $hargaSampah = HargaSampah::findOrFail($id);
        return view('admin.harga-sampah.edit', compact('hargaSampah'));
    }

    public function update(Request $request, $id)
    {
        $hargaSampah = HargaSampah::findOrFail($id);
        
        $request->validate([
            'jenis_sampah' => 'required|string|max:255',
            'kategori' => 'required|string',
            'harga_per_kg' => 'required|numeric|min:0',
            'satuan' => 'required|string'
        ]);

        $hargaSampah->update($request->all());

        return redirect()->route('admin.harga-sampah')->with('success', 'Harga sampah berhasil diupdate!');
    }

    public function destroy($id)
    {
        $hargaSampah = HargaSampah::findOrFail($id);
        $hargaSampah->delete();

        return redirect()->route('admin.harga-sampah')->with('success', 'Harga sampah berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $hargaSampah = HargaSampah::findOrFail($id);
        $hargaSampah->status = !$hargaSampah->status;
        $hargaSampah->save();

        return redirect()->back()->with('success', 'Status harga sampah berhasil diubah!');
    }
}