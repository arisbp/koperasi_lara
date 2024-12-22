<x-app-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/admin-dashboard-modern.css') }}">
    </head>

    <x-slot name="header">
        <div class="header-content">
            <h2 class="header-title">Dashboard Admin</h2>
            <p class="header-subtitle">Selamat datang di dashboard admin koperasi simpan pinjam</p>
        </div>
    </x-slot>

    <div class="dashboard-container">
        <!-- Grid Layout -->
        <div class="grid">
            <!-- Card 1: Kelola Data Simpanan -->
            <div class="card">
                <div class="card-icon bg-blue">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Kelola Data Simpanan</h3>
                    <p class="card-text">Kelola data simpanan anggota dengan mudah.</p>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-primary">Lihat Transaksi</a>
                </div>
            </div>

            <!-- Card 2: Kelola Data Anggota -->
            <div class="card">
                <div class="card-icon bg-yellow">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Kelola Data Anggota</h3>
                    <p class="card-text">Kelola data anggota koperasi dengan praktis.</p>
                    <a href="{{ route('admin.anggota') }}" class="btn btn-warning">Lihat Anggota</a>
                </div>
            </div>

            <!-- Card 3: Verifikasi Pinjaman -->
            <div class="card">
                <div class="card-icon bg-green">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Verifikasi Pinjaman</h3>
                    <p class="card-text">Verifikasi dan kelola data pinjaman anggota.</p>
                    <a href="{{ route('admin.pinjaman') }}" class="btn btn-success">Lihat Pinjaman</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
