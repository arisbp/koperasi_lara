<x-app-layout>
    <head>
        <!-- Include Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/simpanan.css') }}">
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Data Simpanan') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="card">
            <!-- Total Simpanan -->
            <div class="total-simpanan">
                <h2>Total Simpanan: 
                    <span class="text-green-500">
                        Rp {{ number_format($totalSimpanan ?? 0, 0, ',', '.') }}
                    </span>
                </h2>
            </div>

            <!-- Pesan Jika Tidak Ada Transaksi -->
            @if(isset($transaksi) && $transaksi->isEmpty())
                <p class="text-red-500">
                    Anda belum memiliki transaksi simpanan. Silakan mulai dengan melakukan setor simpanan.
                </p>
            @endif

            <!-- Form Setor Simpanan -->
            <form method="POST" action="{{ route('member.simpanan.setor') }}">
                @csrf
                <h3>Setor Simpanan</h3>
                <input 
                    type="number" 
                    name="jumlah" 
                    placeholder="Masukkan jumlah setor" 
                    required
                >
                <button type="submit" class="bg-blue-500">Setor</button>
            </form>

            <!-- Form Tarik Simpanan -->
            <form method="POST" action="{{ route('member.simpanan.tarik') }}">
                @csrf
                <h3>Tarik Simpanan</h3>
                <input 
                    type="number" 
                    name="jumlah" 
                    placeholder="Masukkan jumlah tarik" 
                    required
                >
                <button type="submit" class="bg-red-500">Tarik</button>
            </form>

            <!-- Form Histori Transaksi -->
            <form method="POST" action="{{ route('member.simpanan.transaksi') }}">
                @csrf
                <h3>Histori Transaksi</h3>
                <button type="submit" class="bg-gray-500">Tampilkan Histori Transaksi</button>
            </form>
        </div>
    </div>
</x-app-layout>
