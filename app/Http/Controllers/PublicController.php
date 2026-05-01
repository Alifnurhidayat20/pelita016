<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Galeri;
use App\Models\HargaSampah;

class PublicController extends Controller
{
    public function index()
    {
        $kegiatanTerbaru = Kegiatan::where('status', '!=', 'cancelled')
            ->orderBy('tanggal_mulai', 'desc')
            ->take(3)
            ->get();
        
        $galeriTerbaru = Galeri::orderBy('tanggal_unggah', 'desc')
            ->take(6)
            ->get();
        
        $statistik = [
            'total_nasabah' => \App\Models\Nasabah::count(),
            'total_setoran' => \App\Models\Setoran::where('status', 'diterima')->sum('berat'),
            'total_sampah_terkumpul' => \App\Models\Setoran::where('status', 'diterima')->count(),
        ];
        
        return view('public.home', compact('kegiatanTerbaru', 'galeriTerbaru', 'statistik'));
    }

    public function profil()
    {
        return view('public.profil');
    }

    public function kegiatan()
    {
        $kegiatan = Kegiatan::orderBy('tanggal_mulai', 'desc')->paginate(9);
        return view('public.kegiatan', compact('kegiatan'));
    }

    public function kegiatanDetail($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('public.kegiatan-detail', compact('kegiatan'));
    }

    public function galeri()
    {
        $galeri = Galeri::orderBy('tanggal_unggah', 'desc')->paginate(12);
        return view('public.galeri', compact('galeri'));
    }

    public function kontak()
    {
        return view('public.kontak');
    }

    public function hargaSampah()
    {
        $hargaSampah = HargaSampah::where('status', true)->get();
        return view('public.harga-sampah', compact('hargaSampah'));
    }
}