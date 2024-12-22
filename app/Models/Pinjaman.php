<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    //   use HasFactory;
    use HasFactory;

    // Tambahkan properti jika nama tabel tidak sesuai dengan plural model
    protected $table = 'pinjaman';  // Pastikan nama tabel sesuai
    protected $fillable = ['nama_anggota',
        'jumlah_pinjaman',
        'tanggal_pinjaman',
        'status_pinjaman',
        'tanggal_jatuh_tempo'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);  // Relasi balik ke User
    }


        public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
