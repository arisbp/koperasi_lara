<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    // Pastikan model mengarah ke tabel 'simpanan'
    protected $table = 'simpanan';

    protected $fillable = ['user_id', 'total_simpanan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaksi::class);
    }
}


