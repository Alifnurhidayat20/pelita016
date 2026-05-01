<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\Nasabah;
use App\Models\HargaSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetoranController extends Controller
{
    public function index()
    {
        $setorans = Setoran::with(['nasabah.user', 'hargaSampah'])->latest()->paginate(20);
        return view('admin.setoran.index', compact('setorans'));
    }

    public function create()
    {
        $nasabahs = Nasabah::with('user')->where('status', 'aktif')->get();
        $hargaSampahs = HargaSampah::where('status', true)->get();
        return view('admin.setoran.create', compact('nasabahs', 'hargaSampahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id' => 'required',
            'harga_sampah_id' => 'required',
            'berat' => 'required|numeric|min:0.1',
            'tanggal_setor' => 'required|date'
        ]);

        $hargaSampah = HargaSampah::find($request->harga_sampah_id);
        $totalHarga = $hargaSampah->harga_per_kg * $request->berat;
        
        $kodeTransaksi = 'TRX-' . date('Ymd') . '-' . strtoupper(uniqid());

        Setoran::create([
            'nasabah_id' => $request->nasabah_id,
            'harga_sampah_id' => $request->harga_sampah_id,
            'kode_transaksi' => $kodeTransaksi,
            'berat' => $request->berat,
            'total_harga' => $totalHarga,
            'tanggal_setor' => $request->tanggal_setor,
            'status' => 'diterima',
            'verified_by' => Auth::id(),
            'verified_at' => now()
        ]);

        // Update saldo nasabah
        $nasabah = Nasabah::find($request->nasabah_id);
        $nasabah->saldo += $totalHarga;
        $nasabah->save();

        return redirect()->route('admin.setoran')->with('success', 'Setoran berhasil ditambahkan!');
    }
}