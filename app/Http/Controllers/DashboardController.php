<?php
namespace App\Http\Controllers;

use App\Models\Simpanan;
use App\Models\Pinjaman;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user(); 

        if (!$user) {
            // Jika pengguna tidak login, arahkan ke halaman login
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Hitung saldo simpanan
        $saldoSimpanan = Simpanan::where('user_id', Auth::id())
            ->sum('total_simpanan');

        // Ambil total pinjaman aktif
        $pinjamanAktif = Pinjaman::where('nama_anggota', $user->name) // Pastikan kolom name pada tabel users sesuai
            ->where('status_pinjaman', 'aktif') // Pastikan status 'aktif' sesuai kondisi Anda
            ->sum('jumlah_pinjaman');

        // Ambil riwayat transaksi dengan pencarian jika ada
        $riwayatTransaksi = Transaksi::where('user_id', Auth::id())
            ->when($request->search, function($query) use ($request) {
                $query->where('deskripsi', 'like', '%' . $request->search . '%')
                      ->orWhere('jumlah', 'like', '%' . $request->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Menambahkan paginasi

        // Kirim data ke view
        return view('member.dashboard', compact('saldoSimpanan', 'pinjamanAktif', 'riwayatTransaksi'));
    }
}
