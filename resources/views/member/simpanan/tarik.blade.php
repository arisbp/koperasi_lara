<!-- resources/views/simpanan/tarik.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tarik Simpanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-100 text-gray-900">
                    <h1 class="text-lg font-semibold mb-4">Tarik Simpanan</h1>

                    <form method="POST" action="{{ route('simpanan.tarik') }}">
                        @csrf
                        <div class="flex items-center mb-4">
                            <input 
                                type="number" 
                                name="jumlah" 
                                placeholder="Masukkan jumlah tarik" 
                                class="border rounded px-4 py-2 w-full"
                                required
                            >
                            <button 
                                type="submit" 
                                class="bg-red-500 text-white px-4 py-2 rounded ml-2 hover:bg-red-600">
                                Tarik
                            </button>
                        </div>
                    </form>

                    @if(session('success'))
                        <p class="text-green-500">{{ session('success') }}</p>
                    @elseif(session('error'))
                        <p class="text-red-500">{{ session('error') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
    