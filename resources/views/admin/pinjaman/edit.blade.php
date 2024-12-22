<x-app-layout>
    <head>
        <!-- Include Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/pinjaman.css') }}">
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pinjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-100 text-gray-900">
                    <h1 class="text-lg font-semibold mb-4">Edit Pinjaman</h1>

                    <form action="{{ route('pinjaman.update', $pinjaman->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="nama_anggota" class="block text-sm font-medium text-gray-700">Nama Anggota</label>
                            <input 
                                type="text" 
                                id="nama_anggota" 
                                name="nama_anggota" 
                                value="{{ old('nama_anggota', $pinjaman->nama_anggota) }}" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                required>
                            @error('nama_anggota')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="jumlah_pinjaman" class="block text-sm font-medium text-gray-700">Jumlah Pinjaman</label>
                            <input 
                                type="number" 
                                id="jumlah_pinjaman" 
                                name="jumlah_pinjaman" 
                                value="{{ old('jumlah_pinjaman', $pinjaman->jumlah_pinjaman) }}" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                required>
                            @error('jumlah_pinjaman')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Input Tanggal Jatuh Tempo -->
                        <div>
                            <label for="tanggal_jatuh_tempo" class="block text-sm font-medium text-gray-700">Tanggal Jatuh Tempo</label>
                            <input 
                                type="date" 
                                id="tanggal_jatuh_tempo" 
                                name="tanggal_jatuh_tempo" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                value="{{ $pinjaman->tanggal_jatuh_tempo }}" 
                                required>
                        </div>

                        <div>
                            <label for="status_pinjaman" class="block text-sm font-medium text-gray-700">Status Pinjaman</label>
                            <select 
                                id="status_pinjaman" 
                                name="status_pinjaman" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                required>
                                <option value="pending" {{ old('status_pinjaman', $pinjaman->status_pinjaman) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="aktif" {{ old('status_pinjaman', $pinjaman->status_pinjaman) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="lunas" {{ old('status_pinjaman', $pinjaman->status_pinjaman) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="batal" {{ old('status_pinjaman', $pinjaman->status_pinjaman) == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                            @error('status_pinjaman')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <button 
                            type="submit" 
                            class="button"
                            aria-label="Update Pinjaman">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
