<x-app-layout>
    <head>
        <!-- Include Dashboard CSS -->
        <link rel="stylesheet" href="{{ asset('css/pinjaman.css') }}">
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-white leading-tight">
            {{ __('Data Pinjaman') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#497449]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="p-6">
                    <h1 class="text-xl font-semibold mb-4">Data Pinjaman</h1>

                    <!-- Menampilkan Pesan Sukses -->
                    @if(session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Tombol Tambah Pinjaman -->
                    <a 
                        href="{{ route('member.pinjaman.create') }}" 
                        class="btn-blue">
                        Tambah Pinjaman
                    </a>

                    <!-- Tabel Data Pinjaman -->
                    <table class="table-auto table-large border-collapse border border-gray-300 w-full">
                        <thead class="bg-green-100">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Nama Anggota</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Jumlah Pinjaman</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Status Pinjaman</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($pinjaman as $pinjam)
                                <tr class="text-center">
                                    <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $pinjam->nama_anggota }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ number_format($pinjam->jumlah_pinjaman, 0, ',', '.') }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if($pinjam->status_pinjaman == 'aktif')
                                            <span class="text-green-600">Aktif</span>
                                        @elseif($pinjam->status_pinjaman == 'lunas')
                                            <span class="text-blue-600">Lunas</span>
                                        @elseif($pinjam->status_pinjaman == 'pending')
                                            <span class="text-[#FFC107]">Pending</span>
                                        @else
                                            <span class="text-red-600">Batal</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if($pinjam->status_pinjaman == 'aktif')
                                            <a href="{{ route('pinjaman.bayar', $pinjam->id) }}" class="btn-green">
                                                Bayar Pinjaman
                                            </a>
                                        @else
                                            <span class="text-gray-500">Tidak dapat dibayar</span>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">Data tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
