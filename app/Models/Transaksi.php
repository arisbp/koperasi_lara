<?php
    
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi_simpanan'; // Nama tabel harus sesuai

    protected $fillable = ['user_id', 'simpanan_id', 'jumlah', 'jenis_transaksi'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function simpanan()
    {
        return $this->belongsTo(Simpanan::class);
    }
}
