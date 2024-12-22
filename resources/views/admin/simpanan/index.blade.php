<x-app-layout>
    <head>
        <!-- Include Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/simpanan.css') }}">
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-black">
            {{ __('Histori Transaksi Simpanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-50 text-gray-900">
                    <h1 class="text-xl font-semibold mb-4">Histori Transaksi Simpanan</h1>

                    <!-- Form Pencarian -->
                    <form method="GET" action="{{ route('transaksi.index') }}" class="mb-4">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request()->get('search') }}" 
                            placeholder="Cari Nama Anggota atau Jumlah Transaksi" 
                            class="px-4 py-2 border border-gray-300 rounded-lg w-full max-w-md"
                        >
                        <button type="submit" class="mt-2 bg-blue-600 text-black px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                            Cari
                        </button>
                    </form>

                    <!-- Tabel Transaksi Simpanan -->
                    <table class="table-auto border-collapse border border-gray-300 w-full">
                        <thead class="bg-green-100">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Nama Anggota</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Jenis Transaksi</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Jumlah</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($transaksi as $item)
                            <tr class="text-center">
                                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->user->name }}</td>
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
                                <td colspan="5" class="border border-gray-300 px-4 py-2 text-center">
                                    Tidak ada data transaksi.
                                </td>
                            </tr>
                        @endforelse
                        
                        </tbody>
                    </table>

                    <!-- Paginasi -->
                    <div class="mt-4">
                        {{ $transaksi->links() }} <!-- Paginasi -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
