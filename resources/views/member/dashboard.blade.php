<x-app-layout>
    <head>
        <!-- Include Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    </head>

    <x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight text-left">
        {{ __('Dashboard Koperasi Simpan Pinjam') }}
    </h2>

    </x-slot>

    <!-- Container -->
    <div class="container py-12">
        <!-- Info Section -->
        <div class="info-section mb-6">
            <!-- Saldo Simpanan -->
            <div class="info-card blue">
                <h3>Saldo Simpanan</h3>
                <p>Rp {{ number_format($saldoSimpanan ?? 0, 0, ',', '.') }}</p>
            </div>

            <!-- Pinjaman Aktif -->
            <div class="info-card green">
                <h3>Pinjaman Aktif</h3>
                <p>Rp {{ number_format($pinjamanAktif ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Transactions Section -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis Transaksi</th>
                    <th class="text-center">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayatTransaksi as $key => $transaksi)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $transaksi->created_at->format('d-m-Y') }}</td>
                        <td>{{ ucfirst($transaksi->jenis_transaksi) }}</td>
                        <td class="{{ $transaksi->jumlah > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $transaksi->jumlah > 0 ? '+ ' : '- ' }}Rp {{ number_format(abs($transaksi->jumlah), 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="no-data">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
