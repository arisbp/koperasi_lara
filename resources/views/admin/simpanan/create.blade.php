<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Simpanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-100 text-gray-900">
                    <h1 class="text-lg font-semibold mb-4">Tambah Simpanan</h1>

                    <form action="{{ route('simpanan.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="nama_anggota" class="block text-sm font-medium text-gray-700">Nama Anggota</label>
                            <input 
                                type="text" 
                                id="nama_anggota" 
                                name="nama_anggota" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                required>
                        </div>
                        <div>
                            <label for="jumlah_simpanan" class="block text-sm font-medium text-gray-700">Jumlah Simpanan</label>
                            <input 
                                type="number" 
                                id="jumlah_simpanan" 
                                name="jumlah_simpanan" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                required>
                        </div>
                        <button 
                            type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>