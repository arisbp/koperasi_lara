<x-app-layout>
    <head>
        <!-- Include Simpanan CSS -->
        <link rel="stylesheet" href="{{ asset('css/simpanan.css') }}">
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-white leading-tight">
            {{ __('Pembayaran Pinjaman') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#497449]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="p-6">
                    <h1 class="text-xl font-semibold mb-4">Pembayaran Pinjaman</h1>

                    <!-- Form Pembayaran -->
                    <form action="{{ route('pinjaman.bayar.pinjam', $pinjaman->id) }}" method="POST" class="mb-6">
                        @csrf
                        <div class="mb-4">
                            <label for="jumlah_pembayaran" class="block text-sm font-medium text-gray-700">Jumlah Pembayaran</label>
                            <input 
                                type="number" 
                                name="jumlah_pembayaran" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                placeholder="Masukkan jumlah pembayaran"
                                required>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn-green">
                                Bayar
                            </button>
                        </div>
                    </form>

                    <!-- Informasi Pinjaman -->
                    <div class="info-section">
                        <h3 class="font-semibold text-lg">Nama Anggota: 
                            <span class="text-gray-700">{{ $pinjaman->nama_anggota }}</span>
                        </h3>
                        <p>Status Pinjaman: 
                            @if($pinjaman->status_pinjaman == 'aktif')
                                <span class="text-green-600">Aktif</span>
                            @elseif($pinjaman->status_pinjaman == 'lunas')
                                <span class="text-blue-600">Lunas</span>
                            @else
                                <span class="text-red-600">Batal</span>
                            @endif
                        </p>
                        <p>Jumlah Pinjaman: 
                            <span class="font-semibold text-gray-700">
                                Rp {{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
