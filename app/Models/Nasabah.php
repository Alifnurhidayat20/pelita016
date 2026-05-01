<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'no_rekening', 'saldo', 'nik', 'tempat_lahir', 
        'tanggal_lahir', 'jenis_kelamin', 'pekerjaan', 'status', 'foto'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'saldo' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setorans()
    {
        return $this->hasMany(Setoran::class);
    }

    public function penarikans()
    {
        return $this->hasMany(Penarikan::class);
    }

    public function totalSetoran()
    {
        return $this->setorans()->where('status', 'diterima')->sum('total_harga');
    }
}