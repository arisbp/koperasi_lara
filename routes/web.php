<?php

use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use App\Models\User;
// Route dasar
Route::get('/', function () {
    return view('welcome');
});

// Middleware untuk profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk member yang sudah terverifikasi
Route::get('/cek1', function () {
    return '<h1>cek1</h1>';
})->middleware(['auth', 'verified']);

// Routes untuk Member/User
Route::middleware(['auth', 'MemberMiddleware'])->group(function () {
    // Dashboard member
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Transaksi member
    Route::get('/user/transaksi', [MemberController::class, 'transaksi'])->name('user.transaksi');

    // Laporan simpanan member
    Route::get('user/simpanan', [MemberController::class, 'simpanan'])->name('user.simpanan');

    // Laporan pinjaman member
    Route::get('user/pinjaman', [PinjamanController::class, 'index'])->name('user.pinjaman');
});

// Routes untuk Admin
Route::middleware(['auth', 'AdminMiddleware'])->group(function () {
    // Dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Simpanan admin
    Route::get('admin/simpanan', [AdminController::class, 'simpanan'])->name('admin.simpanan');

    // Pinjaman admin
    Route::get('admin/pinjaman', [AdminController::class, 'pinjaman'])->name('admin.pinjaman');

    // Anggota admin
    Route::get('/admin/anggota', function () {
        // Mengambil semua pengguna dengan usertype 'user'
        $users = User::where('usertype', 'user')->paginate(10);
        return view('admin.anggota', compact('users'));
    })->name('admin.anggota');

    // Laporan admin
    Route::get('admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');

    // Transaksi admin
    Route::get('admin/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('admin/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
});

// CRUD Routes untuk Simpanan
Route::middleware('auth')->group(function () {
    Route::get('/simpanan', [SimpananController::class, 'index'])->name('simpanan.index');
    Route::get('simpanan/create', [SimpananController::class, 'create'])->name('simpanan.create');
    Route::post('simpanan', [SimpananController::class, 'store'])->name('simpanan.store');
    Route::get('simpanan/{simpanan}/edit', [SimpananController::class, 'edit'])->name('simpanan.edit');
    Route::put('simpanan/{simpanan}', [SimpananController::class, 'update'])->name('simpanan.update');
    Route::delete('simpanan/{simpanan}', [SimpananController::class, 'destroy'])->name('simpanan.destroy');
    Route::get('/member/simpanan', [SimpananController::class, 'index'])->name('member.simpanan.index');

    // Setor dan Tarik Simpanan
    Route::post('/member/simpanan/setor', [SimpananController::class, 'setor'])->name('member.simpanan.setor');
    Route::post('/member/simpanan/tarik', [SimpananController::class, 'tarik'])->name('member.simpanan.tarik');
    Route::get('/member/simpanan/transaksi', [SimpananController::class, 'transaksi'])->name('member.simpanan.transaksi');
    Route::post('/member/simpanan/transaksi', [ SimpananController::class, 'transaksi'])->name('member.simpanan.transaksi');
});

// CRUD Routes untuk Pinjaman (Admin)
Route::get('admin/pinjaman/index', [PinjamanController::class, 'indexAdmin'])->name('pinjaman.index');
// Route untuk menampilkan form input data pinjaman
Route::get('admin/pinjaman/create', [PinjamanController::class, 'create'])->name('pinjaman.create');
Route::post('pinjaman', [PinjamanController::class, 'store'])->name('pinjaman.store');
//update
Route::get('/pinjaman/{pinjaman}/edit', [PinjamanController::class, 'edit'])->name('pinjaman.edit'); // Form Edit Pinjaman
Route::put('pinjaman/{pinjaman}', [PinjamanController::class, 'update'])->name('pinjaman.update'); // Proses Update Pinjaman
//delete
Route::delete('pinjaman/{pinjaman}', [PinjamanController::class, 'destroy'])->name('pinjaman.destroy'); // Hapus Pinjaman

Route::get('/pinjaman/create', [PinjamanController::class, 'memberCreate'])->name('member.pinjaman.create');


// Route untuk form pembayaran   pinjaman
Route::get('/pinjaman/{pinjamanId}/bayar', [PembayaranController::class, 'bayarForm'])->name('pinjaman.bayar');

// Route untuk memproses pembayaran pinjaman
Route::post('/pinjaman/{pinjamanId}/bayar', [PembayaranController::class, 'bayarPinjaman'])->name('pinjaman.bayar.pinjam');



// Memasukkan file route auth
require __DIR__.'/auth.php';
