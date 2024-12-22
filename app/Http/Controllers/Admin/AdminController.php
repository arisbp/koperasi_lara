<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\Simpanan;
use App\models\Pinjaman;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function simpanan()
    {
        $simpanan = Simpanan::all(); // Mengambil semua data simpanan dari tabel
        return view('admin.simpanan.index', compact('simpanan'));
    }
    public function pinjaman()
    {
        // Mengambil semua data pinjaman dari tabel
        $pinjaman = Pinjaman::all();
        return view('admin.pinjaman.index', compact('pinjaman'));
    }


    public function anggota()
    {
        // Mengambil semua pengguna dari tabel users
        $users = User::all(); // Mengambil semua data pengguna

        return view('admin.anggota', compact('users')); // Mengirim data pengguna ke view
    }
     
}


