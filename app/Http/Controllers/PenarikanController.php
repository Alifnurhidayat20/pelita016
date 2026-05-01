<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenarikanController extends Controller
{
    public function index()
    {
        $penarikans = Penarikan::with('nasabah.user')->latest()->paginate(20);
        return view('admin.penarikan.index', compact('penarikans'));
    }

    public function approve($id)
    {
        $penarikan = Penarikan::findOrFail($id);
        $nasabah = $penarikan->nasabah;

        if ($nasabah->saldo >= $penarikan->jumlah) {
            $nasabah->saldo -= $penarikan->jumlah;
            $nasabah->save();

            $penarikan->status = 'disetujui';
            $penarikan->processed_by = Auth::id();
            $penarikan->processed_at = now();
            $penarikan->save();

            return redirect()->back()->with('success', 'Penarikan berhasil disetujui!');
        }

        return redirect()->back()->with('error', 'Saldo nasabah tidak mencukupi!');
    }

    public function reject(Request $request, $id)
    {
        $penarikan = Penarikan::findOrFail($id);
        $penarikan->status = 'ditolak';
        $penarikan->keterangan = $request->keterangan;
        $penarikan->save();

        return redirect()->back()->with('success', 'Penarikan ditolak!');
    }

    public function complete($id)
    {
        $penarikan = Penarikan::findOrFail($id);
        $penarikan->status = 'selesai';
        $penarikan->save();

        return redirect()->back()->with('success', 'Penarikan selesai diproses!');
    }
}