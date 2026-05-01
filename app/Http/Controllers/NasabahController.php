<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Setoran;
use App\Models\Penarikan;
use App\Models\HargaSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NasabahController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role !== 'nasabah') {
                abort(403, 'Akses ditolak. Hanya untuk nasabah.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $nasabah = Auth::user()->nasabah;
        $totalSetoran = $nasabah->setorans()->where('status', 'diterima')->sum('total_harga');
        $totalPenarikan = $nasabah->penarikans()->where('status', 'selesai')->sum('jumlah');
        $saldoAktif = $nasabah->saldo;
        
        $setoranTerbaru = $nasabah->setorans()->with('hargaSampah')->latest()->take(5)->get();
        $penarikanTerbaru = $nasabah->penarikans()->latest()->take(5)->get();
        
        return view('nasabah.dashboard', compact('nasabah', 'totalSetoran', 'totalPenarikan', 'saldoAktif', 'setoranTerbaru', 'penarikanTerbaru'));
    }

    public function setoranForm()
    {
        $hargaSampah = HargaSampah::where('status', true)->get();
        return view('nasabah.setoran', compact('hargaSampah'));
    }

    public function storeSetoran(Request $request)
    {
        $request->validate([
            'harga_sampah_id' => 'required|exists:harga_sampahs,id',
            'berat' => 'required|numeric|min:0.1',
            'tanggal_setor' => 'required|date',
            'bukti_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $nasabah = Auth::user()->nasabah;
        $hargaSampah = HargaSampah::find($request->harga_sampah_id);
        $totalHarga = $hargaSampah->harga_per_kg * $request->berat;

        $kodeTransaksi = 'TRX-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        $setoran = Setoran::create([
            'nasabah_id' => $nasabah->id,
            'harga_sampah_id' => $request->harga_sampah_id,
            'kode_transaksi' => $kodeTransaksi,
            'berat' => $request->berat,
            'total_harga' => $totalHarga,
            'tanggal_setor' => $request->tanggal_setor,
            'status' => 'pending',
        ]);

        if ($request->hasFile('bukti_foto')) {
            $file = $request->file('bukti_foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/bukti'), $filename);
            $setoran->update(['bukti_foto' => $filename]);
        }

        return redirect()->route('nasabah.riwayat')->with('success', 'Setoran berhasil diajukan!');
    }

    public function riwayat()
    {
        $nasabah = Auth::user()->nasabah;
        $setorans = $nasabah->setorans()->with('hargaSampah')->latest()->paginate(10);
        $penarikans = $nasabah->penarikans()->latest()->paginate(10);
        
        return view('nasabah.riwayat', compact('setorans', 'penarikans'));
    }

    public function penarikanForm()
    {
        $nasabah = Auth::user()->nasabah;
        return view('nasabah.penarikan', compact('nasabah'));
    }

    public function storePenarikan(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:10000',
            'metode_penarikan' => 'required|in:tunai,transfer'
        ]);

        $nasabah = Auth::user()->nasabah;

        if ($nasabah->saldo < $request->jumlah) {
            return back()->with('error', 'Saldo tidak mencukupi!');
        }

        $kodePenarikan = 'WDR-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        Penarikan::create([
            'nasabah_id' => $nasabah->id,
            'kode_penarikan' => $kodePenarikan,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
            'metode_penarikan' => $request->metode_penarikan
        ]);

        return redirect()->route('nasabah.riwayat')->with('success', 'Permintaan penarikan berhasil diajukan!');
    }
}