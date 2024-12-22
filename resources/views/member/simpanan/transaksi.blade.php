<x-app-layout>
    <head>
        <!-- Include Dashboard CSS -->
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-white leading-tight">
            {{ __('Histori Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#497449]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="p-6">
                    <h1 class="text-xl font-semibold mb-4">Histori Transaksi</h1>

                    <!-- Form Pencarian -->
                    <form method="GET" action="{{ route('member.simpanan.transaksi') }}" class="mb-4">
                        <div class="flex items-center gap-2">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request()->get('search') }}" 
                                placeholder="Cari Jumlah Transaksi" 
                                class="px-4 py-2 border border-gray-300 rounded-lg w-full max-w-md"
                            >
                            <button 
                                type="submit" 
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-300">
                                Cari
                            </button>
                        </div>
                    </form>

                    <!-- Tabel Histori Transaksi -->
                    <table class="table-auto border-collapse border border-gray-300 w-full">
                        <thead class="bg-green-100">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Jenis Transaksi</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Jumlah</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($transaksi as $item)
                            <tr class="text-center">
                                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <span class="{{ $item->jenis_transaksi == 'setoran' ? 'text-green-500' : 'text-red-500' }}">
                                        {{ ucfirst($item->jenis_transaksi) }}
                                    </span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                    Tidak ada transaksi ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Kontrol Paginasi -->
                    <div class="mt-4">
                        {{ $transaksi->links() }} <!-- Menampilkan kontrol halaman -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
