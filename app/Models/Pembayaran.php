<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pinjaman_id', 
        'jumlah_pembayaran', 
        'denda', 
        'tanggal_pembayaran'
    ];

    // Relasi dengan model Pinjaman
    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class,'pinjaman_id','id');
    }
}
