<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nasabah;
use App\Models\Setoran;
use App\Models\Penarikan;
use App\Models\Kegiatan;
use App\Models\Galeri;
use App\Models\HargaSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role !== 'admin') {
                abort(403, 'Akses ditolak. Hanya untuk admin.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $totalNasabah = Nasabah::count();
        $totalSetoran = Setoran::where('status', 'diterima')->sum('total_harga');
        $totalPenarikan = Penarikan::where('status', 'selesai')->sum('jumlah');
        $totalBeratSampah = Setoran::where('status', 'diterima')->sum('berat');
        $setoranHariIni = Setoran::whereDate('created_at', today())->count();
        $pendingPenarikan = Penarikan::where('status', 'pending')->count();
        
        return view('admin.dashboard', compact(
            'totalNasabah', 'totalSetoran', 'totalPenarikan', 'totalBeratSampah',
            'setoranHariIni', 'pendingPenarikan'
        ));
    }

    // ==================== NASABAH ====================
    public function nasabah()
    {
        $nasabahs = Nasabah::with('user')->latest()->paginate(15);
        return view('admin.nasabah.index', compact('nasabahs'));
    }

    // ==================== SETORAN ====================
    public function setoran()
    {
        $setorans = Setoran::with(['nasabah.user', 'hargaSampah'])->latest()->paginate(20);
        return view('admin.setoran.index', compact('setorans'));
    }

    // ==================== PENARIKAN ====================
    public function penarikan()
    {
        $penarikans = Penarikan::with('nasabah.user')->latest()->paginate(20);
        return view('admin.penarikan.index', compact('penarikans'));
    }

    // ==================== HARGA SAMPAH ====================
    public function hargaSampah()
    {
        $hargaSampahs = HargaSampah::latest()->get();
        return view('admin.harga-sampah.index', compact('hargaSampahs'));
    }

    public function createHargaSampah()
    {
        return view('admin.harga-sampah.create');
    }

    public function storeHargaSampah(Request $request)
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

    public function editHargaSampah($id)
    {
        $hargaSampah = HargaSampah::findOrFail($id);
        return view('admin.harga-sampah.edit', compact('hargaSampah'));
    }

    public function updateHargaSampah(Request $request, $id)
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

    public function destroyHargaSampah($id)
    {
        $hargaSampah = HargaSampah::findOrFail($id);
        $hargaSampah->delete();

        return redirect()->route('admin.harga-sampah')->with('success', 'Harga sampah berhasil dihapus!');
    }

    // ==================== KEGIATAN CRUD ====================
    public function kegiatan()
    {
        $kegiatans = Kegiatan::latest()->paginate(10);
        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    public function createKegiatan()
    {
        return view('admin.kegiatan.create');
    }

    public function storeKegiatan(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
            'kuota' => 'nullable|integer|min:1'
        ]);

        $kegiatan = new Kegiatan();
        $kegiatan->judul = $request->judul;
        $kegiatan->deskripsi = $request->deskripsi;
        $kegiatan->lokasi = $request->lokasi;
        $kegiatan->tanggal_mulai = $request->tanggal_mulai;
        $kegiatan->tanggal_selesai = $request->tanggal_selesai;
        $kegiatan->status = $request->status;
        $kegiatan->kuota = $request->kuota;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $kegiatan->gambar = $filename;
        }

        $kegiatan->save();

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function editKegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function updateKegiatan(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
            'kuota' => 'nullable|integer|min:1'
        ]);

        $kegiatan->judul = $request->judul;
        $kegiatan->deskripsi = $request->deskripsi;
        $kegiatan->lokasi = $request->lokasi;
        $kegiatan->tanggal_mulai = $request->tanggal_mulai;
        $kegiatan->tanggal_selesai = $request->tanggal_selesai;
        $kegiatan->status = $request->status;
        $kegiatan->kuota = $request->kuota;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($kegiatan->gambar && file_exists(public_path('uploads/kegiatan/' . $kegiatan->gambar))) {
                unlink(public_path('uploads/kegiatan/' . $kegiatan->gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $kegiatan->gambar = $filename;
        }

        $kegiatan->save();

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil diupdate!');
    }

    public function destroyKegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        if ($kegiatan->gambar && file_exists(public_path('uploads/kegiatan/' . $kegiatan->gambar))) {
            unlink(public_path('uploads/kegiatan/' . $kegiatan->gambar));
        }
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil dihapus!');
    }

    // ==================== GALERI CRUD ====================
    public function galeri()
    {
        $galeris = Galeri::latest()->paginate(12);
        return view('admin.galeri.index', compact('galeris'));
    }

    public function createGaleri()
    {
        return view('admin.galeri.create');
    }

    public function storeGaleri(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'required|string'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/galeri'), $filename);
        }

        Galeri::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $filename,
            'kategori' => $request->kategori,
            'tanggal_unggah' => now(),
            'views' => 0
        ]);

        return redirect()->route('admin.galeri')->with('success', 'Galeri berhasil ditambahkan!');
    }

    public function editGaleri($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function updateGaleri(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'required|string'
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($galeri->gambar && file_exists(public_path('uploads/galeri/' . $galeri->gambar))) {
                unlink(public_path('uploads/galeri/' . $galeri->gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/galeri'), $filename);
            $galeri->gambar = $filename;
        }

        $galeri->judul = $request->judul;
        $galeri->deskripsi = $request->deskripsi;
        $galeri->kategori = $request->kategori;
        $galeri->save();

        return redirect()->route('admin.galeri')->with('success', 'Galeri berhasil diupdate!');
    }

    public function destroyGaleri($id)
    {
        $galeri = Galeri::findOrFail($id);
        if ($galeri->gambar && file_exists(public_path('uploads/galeri/' . $galeri->gambar))) {
            unlink(public_path('uploads/galeri/' . $galeri->gambar));
        }
        $galeri->delete();

        return redirect()->route('admin.galeri')->with('success', 'Galeri berhasil dihapus!');
    }

    // ==================== LAPORAN ====================
    public function laporan()
    {
        $totalNasabah = Nasabah::count();
        $totalSetoran = Setoran::where('status', 'diterima')->sum('total_harga');
        $totalPenarikan = Penarikan::where('status', 'selesai')->sum('jumlah');
        $totalBerat = Setoran::where('status', 'diterima')->sum('berat');
        
        $setoranPerBulan = Setoran::selectRaw('MONTH(tanggal_setor) as bulan, SUM(total_harga) as total')
            ->where('status', 'diterima')
            ->whereYear('tanggal_setor', date('Y'))
            ->groupBy('bulan')
            ->get();
        
        return view('admin.laporan.index', compact('totalNasabah', 'totalSetoran', 'totalPenarikan', 'totalBerat', 'setoranPerBulan'));
    }

    public function generateLaporan(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:setoran,penarikan,nasabah',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai'
        ]);

        if ($request->jenis == 'setoran') {
            $data = Setoran::with(['nasabah.user', 'hargaSampah'])
                ->whereBetween('tanggal_setor', [$request->tanggal_mulai, $request->tanggal_selesai])
                ->where('status', 'diterima')
                ->get();
            
            $pdf = Pdf::loadView('admin.laporan.setoran-pdf', compact('data', 'request'));
            return $pdf->download('laporan-setoran-' . date('Ymd') . '.pdf');
        } 
        elseif ($request->jenis == 'penarikan') {
            $data = Penarikan::with('nasabah.user')
                ->whereBetween('created_at', [$request->tanggal_mulai, $request->tanggal_selesai])
                ->where('status', 'selesai')
                ->get();
            
            $pdf = Pdf::loadView('admin.laporan.penarikan-pdf', compact('data', 'request'));
            return $pdf->download('laporan-penarikan-' . date('Ymd') . '.pdf');
        } 
        elseif ($request->jenis == 'nasabah') {
            $data = Nasabah::with('user')->get();
            
            $pdf = Pdf::loadView('admin.laporan.nasabah-pdf', compact('data', 'request'));
            return $pdf->download('laporan-nasabah-' . date('Ymd') . '.pdf');
        }
    }

    // ==================== KEUANGAN (PEMASUKAN & PENGELUARAN) ====================
public function keuangan()
{
    $keuangans = \App\Models\Keuangan::with('creator')->latest()->paginate(20);
    
    // Hitung total pemasukan dan pengeluaran
    $totalPemasukan = \App\Models\Keuangan::where('jenis', 'pemasukan')->sum('jumlah');
    $totalPengeluaran = \App\Models\Keuangan::where('jenis', 'pengeluaran')->sum('jumlah');
    $saldoAkhir = $totalPemasukan - $totalPengeluaran;
    
    return view('admin.keuangan.index', compact('keuangans', 'totalPemasukan', 'totalPengeluaran', 'saldoAkhir'));
}

public function createKeuangan()
{
    return view('admin.keuangan.create');
}

public function storeKeuangan(Request $request)
{
    $request->validate([
        'jenis' => 'required|in:pemasukan,pengeluaran',
        'kategori' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'jumlah' => 'required|numeric|min:0',
        'tanggal' => 'required|date',
        'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $kodeTransaksi = 'KEU-' . date('Ymd') . '-' . strtoupper(uniqid());

    $keuangan = new \App\Models\Keuangan();
    $keuangan->kode_transaksi = $kodeTransaksi;
    $keuangan->jenis = $request->jenis;
    $keuangan->kategori = $request->kategori;
    $keuangan->deskripsi = $request->deskripsi;
    $keuangan->jumlah = $request->jumlah;
    $keuangan->tanggal = $request->tanggal;
    $keuangan->created_by = auth()->id();

    if ($request->hasFile('bukti')) {
        $file = $request->file('bukti');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/keuangan'), $filename);
        $keuangan->bukti = $filename;
    }

    $keuangan->save();

    return redirect()->route('admin.keuangan')->with('success', 'Data keuangan berhasil ditambahkan!');
}

public function editKeuangan($id)
{
    $keuangan = \App\Models\Keuangan::findOrFail($id);
    return view('admin.keuangan.edit', compact('keuangan'));
}

public function updateKeuangan(Request $request, $id)
{
    $keuangan = \App\Models\Keuangan::findOrFail($id);

    $request->validate([
        'jenis' => 'required|in:pemasukan,pengeluaran',
        'kategori' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'jumlah' => 'required|numeric|min:0',
        'tanggal' => 'required|date',
        'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $keuangan->jenis = $request->jenis;
    $keuangan->kategori = $request->kategori;
    $keuangan->deskripsi = $request->deskripsi;
    $keuangan->jumlah = $request->jumlah;
    $keuangan->tanggal = $request->tanggal;

    if ($request->hasFile('bukti')) {
        if ($keuangan->bukti && file_exists(public_path('uploads/keuangan/' . $keuangan->bukti))) {
            unlink(public_path('uploads/keuangan/' . $keuangan->bukti));
        }
        $file = $request->file('bukti');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/keuangan'), $filename);
        $keuangan->bukti = $filename;
    }

    $keuangan->save();

    return redirect()->route('admin.keuangan')->with('success', 'Data keuangan berhasil diupdate!');
}

public function destroyKeuangan($id)
{
    $keuangan = \App\Models\Keuangan::findOrFail($id);
    if ($keuangan->bukti && file_exists(public_path('uploads/keuangan/' . $keuangan->bukti))) {
        unlink(public_path('uploads/keuangan/' . $keuangan->bukti));
    }
    $keuangan->delete();

    return redirect()->route('admin.keuangan')->with('success', 'Data keuangan berhasil dihapus!');
}

public function laporanKeuangan()
{
    $pemasukanPerBulan = \App\Models\Keuangan::selectRaw('MONTH(tanggal) as bulan, SUM(jumlah) as total')
        ->where('jenis', 'pemasukan')
        ->whereYear('tanggal', date('Y'))
        ->groupBy('bulan')
        ->get();
    
    $pengeluaranPerBulan = \App\Models\Keuangan::selectRaw('MONTH(tanggal) as bulan, SUM(jumlah) as total')
        ->where('jenis', 'pengeluaran')
        ->whereYear('tanggal', date('Y'))
        ->groupBy('bulan')
        ->get();
    
    $totalPemasukan = \App\Models\Keuangan::where('jenis', 'pemasukan')->sum('jumlah');
    $totalPengeluaran = \App\Models\Keuangan::where('jenis', 'pengeluaran')->sum('jumlah');
    
    return view('admin.keuangan.laporan', compact('pemasukanPerBulan', 'pengeluaranPerBulan', 'totalPemasukan', 'totalPengeluaran'));
}
}