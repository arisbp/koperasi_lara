<x-app-layout>
    <head>
        <!-- Include Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/simpanan.css') }}">
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Users Section -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Daftar Anggota</h3>
                <table class="table-auto w-full text-left text-base">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-center">No</th>
                            <th class="px-4 py-2 text-center">Nama Pengguna</th>
                            <th class="px-4 py-2 text-center">Username</th>
                            <th class="px-4 py-2 text-center">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut -->
                                <td class="border px-4 py-2">{{ $user->name }}</td>
                                <td class="border px-4 py-2">{{ $user->username }}</td>
                                <td class="border px-4 py-2">{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Tautan Pagination -->
                <div class="mt-4">
                    {{ $users->links() }} <!-- Menampilkan tautan pagination -->
                </div>

            </div>
        </div>
    </div>
</x-app-layout>