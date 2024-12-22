<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi simpanan dengan pencarian dan paginasi
    public function index(Request $request)
    {
        // Ambil data transaksi dengan pencarian jika ada
        $transaksi = Transaksi::when($request->search, function($query) use ($request) {
            // Jika ada pencarian, filter berdasarkan nama anggota atau jumlah transaksi
            $query->whereHas('user', function($q) use ($request) {
                // Filter berdasarkan nama anggota
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->orWhere('jumlah', 'like', '%' . $request->search . '%'); // Filter berdasarkan jumlah transaksi
        })
        ->paginate(10); // Menambahkan paginasi 10 item per halaman

        // Kirim data transaksi ke view
        return view('admin.simpanan.index', compact('transaksi'));
    }
}
