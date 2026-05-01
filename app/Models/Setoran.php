<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id', 'harga_sampah_id', 'kode_transaksi', 'berat', 
        'total_harga', 'status', 'catatan', 'tanggal_setor', 'bukti_foto', 
        'verified_by', 'verified_at'
    ];

    protected $casts = [
        'tanggal_setor' => 'date',
        'verified_at' => 'datetime',
        'berat' => 'decimal:2',
        'total_harga' => 'decimal:2'
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function hargaSampah()
    {
        return $this->belongsTo(HargaSampah::class);
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}