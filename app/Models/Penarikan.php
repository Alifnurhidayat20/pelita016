<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id', 'kode_penarikan', 'jumlah', 'status', 'keterangan',
        'metode_penarikan', 'bukti_transfer', 'processed_by', 'processed_at'
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'processed_at' => 'datetime'
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}