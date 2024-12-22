<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    // Menampilkan form pembayaran untuk pinjaman tertentu
    public function bayarForm($pinjamanId)
    {
        // Mencari data pinjaman berdasarkan ID
        $pinjaman = Pinjaman::findOrFail($pinjamanId);

        // Menampilkan form pembayaran
        return view('member.pinjaman.bayar', compact('pinjaman'));
    }

    // Proses pembayaran pinjaman
    public function bayarPinjaman(Request $request, $pinjamanId)
    {
        // Validasi input
        $request->validate([
            'jumlah_pembayaran' => 'required|numeric|min:1000',
        ]);

        // Ambil data pinjaman berdasarkan ID
        $pinjaman = Pinjaman::findOrFail($pinjamanId);

        // Ambil data pembayaran dari form
        $jumlahPembayaran = $request->input('jumlah_pembayaran');
        $tanggalPembayaran = now();

        // Cek apakah pembayaran terlambat
        $tanggalJatuhTempo = $pinjaman->tanggal_jatuh_tempo;
        $denda = 0;

        if ($tanggalPembayaran > $tanggalJatuhTempo) {
            // Hitung selisih hari keterlambatan
            $selisihHari = $tanggalPembayaran->diffInDays($tanggalJatuhTempo);
            // Tentukan tarif denda per hari (misalnya Rp 1000 per hari)
            $tarifDendaPerHari = 1000;
            // Hitung denda
            $denda = $selisihHari * $tarifDendaPerHari;
        }

        // Total yang harus dibayar adalah jumlah pinjaman + denda
        $totalPembayaran = $jumlahPembayaran + $denda;

        // Simpan pembayaran
        $pembayaran = new Pembayaran();
        $pembayaran->pinjaman_id = $pinjaman->id;
        $pembayaran->jumlah_pembayaran = $jumlahPembayaran;
        $pembayaran->denda = $denda;
        $pembayaran->tanggal_pembayaran = $tanggalPembayaran;
        $pembayaran->save();

        // Perbarui status pinjaman jika sudah lunas
        if ($pinjaman->jumlah_pinjaman <= $jumlahPembayaran) {
            $pinjaman->status_pinjaman = 'lunas';
            $pinjaman->jumlah_pinjaman = 0;
            $pinjaman->save();
        } else {
            // Kurangi jumlah pinjaman dengan pembayaran
            $pinjaman->jumlah_pinjaman -= $jumlahPembayaran;
            $pinjaman->save();
        }


        // Redirect ke halaman daftar pinjaman dengan pesan sukses
        return redirect()->route('user.pinjaman')->with('status', 'Pembayaran berhasil!');
    }
}
