<x-app-layout>
    <head>
        <!-- Include Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/pinjaman.css') }}">
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-black">
            {{ __('Data Pinjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-50 text-gray-900">
                    <h1 class="text-xl font-semibold mb-4">Data Pinjaman</h1>
                

                    <!-- Form Pencarian -->
                    <form method="GET" action="{{ route('pinjaman.index') }}" class="mb-4">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request()->get('search') }}" 
                            placeholder="Cari Nama Anggota atau Status Pinjaman" 
                            class="px-4 py-2 border border-gray-300 rounded-lg w-full max-w-md"
                        >
                        <button type="submit" class="mt-2 bg-blue-600 text-black px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                            Cari
                        </button>
                    </form>
                    

                    <!-- Menampilkan pesan sukses jika ada -->
                    @if(session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Tabel Data Pinjaman -->
                    <table class="table-auto border-collapse border border-gray-300 w-full">
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
                            <!-- Looping Data Pinjaman -->
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
                                    <!-- Tombol Edit dan Hapus -->
                                    <td class="border border-gray-300 px-4 py-2 flex justify-center gap-4">
                                        <!-- Tombol Edit -->
                                        <a 
                                            href="{{ route('pinjaman.edit', $pinjam->id) }}" 
                                            class="text-blue-600 hover:underline transition-colors duration-300">
                                            Edit
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('pinjaman.destroy', $pinjam->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline transition-colors duration-300">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <!-- Display message if no data is found -->
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-grey-500">Data tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>