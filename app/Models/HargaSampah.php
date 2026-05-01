<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaSampah extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_sampah', 'kategori', 'harga_per_kg', 'deskripsi', 'satuan', 'gambar', 'status'
    ];

    protected $casts = [
        'harga_per_kg' => 'decimal:2'
    ];

    public function setorans()
    {
        return $this->hasMany(Setoran::class);
    }
}