<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pinjaman;

class PinjamanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Ambil query pencarian dari request
        $search = $request->get('search');

        // Filter data pinjaman berdasarkan pengguna yang login dan pencarian
        $pinjaman = Pinjaman::query()
            ->where('nama_anggota', $user->name) // Filter berdasarkan nama anggota yang sedang login
            ->when($search, function ($query) use ($search) {
                // Tambahkan pencarian berdasarkan nama anggota atau status pinjaman
                $query->where(function ($query) use ($search) {
                    $query->where('nama_anggota', 'like', "%{$search}%")
                        ->orWhere('status_pinjaman', 'like', "%{$search}%");
                });
            })
            ->paginate(10); // Tambahkan pagination

        // Kirim data ke view
        return view('member.pinjaman.index', compact('pinjaman'));
    }
    public function indexAdmin(Request $request)
    {
        // Ambil query pencarian dari request
        $search = $request->get('search');

        // Filter data pinjaman berdasarkan pencarian
        $pinjaman = Pinjaman::query()
            ->when($search, function ($query) use ($search) {
                // Cari berdasarkan nama_anggota atau status_pinjaman
                $query->where('nama_anggota', 'like', "%{$search}%")
                    ->orWhere('status_pinjaman', 'like', "%{$search}%");
            })
            ->paginate(10); // Tambahkan pagination

        // Kirim data ke view
        return view('admin.pinjaman.index', compact('pinjaman'));
    }



    public function create()
    {
        return view('admin.pinjaman.create');
    }
    public function memberCreate()
    {
        return view('member.pinjaman.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'nama_anggota' => 'required|string|max:255',
            'jumlah_pinjaman' => 'required|numeric|min:1000',
            'status_pinjaman' => 'required|in:aktif,lunas,batal,pending',
            'tanggal_jatuh_tempo' => 'required|date', // Tambahkan validasi tanggal
        ]);
        
        // Menyimpan data pinjaman ke database
        Pinjaman::create([
            'nama_anggota' => $validatedData['nama_anggota'], // Akses array dengan indeks
            'jumlah_pinjaman' => $validatedData['jumlah_pinjaman'],
            'status_pinjaman' => $validatedData['status_pinjaman'],
            'tanggal_jatuh_tempo' => $validatedData['tanggal_jatuh_tempo'], // Simpan tanggal jatuh tempo
        ]);
        
        if(Auth::user()->usertype=="admin") {
            return redirect()->route('pinjaman.index')->with('success', 'Pinjaman berhasil ditambahkan!');
        }
        else{
            return redirect()->route('user.pinjaman')->with('success', 'Pinjaman berhasil ditambahkan!');}
        
    }
    

    public function edit($id)
    {
        // Mencari pinjaman berdasarkan ID
        $pinjaman = Pinjaman::find($id);
        return view('admin.pinjaman.edit', compact('pinjaman'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'nama_anggota' => 'required|string|max:255',
            'jumlah_pinjaman' => 'required|numeric|min:1000',
            'status_pinjaman' => 'required|in:aktif,lunas,batal,pending',
            'tanggal_jatuh_tempo' => 'required|date',
        ]);
    
        // Mencari pinjaman berdasarkan ID
        $pinjaman = Pinjaman::find($id);
    
        // Memperbarui data pinjaman
        $pinjaman->update([
            'nama_anggota' => $validatedData['nama_anggota'],
            'jumlah_pinjaman' => $validatedData['jumlah_pinjaman'],
            'status_pinjaman' => $validatedData['status_pinjaman'],
            'tanggal_jatuh_tempo' => $validatedData['tanggal_jatuh_tempo'],
        ]);
        $pinjaman->save();
    
        // Redirect ke halaman daftar pinjaman dengan pesan sukses
        // return redirect()->route('pinjaman.index')->with('success', 'Pinjaman berhasil update!');

        if(Auth::user()->usertype=="admin") {
            return redirect()->route('pinjaman.index')->with('success', 'Pinjaman berhasil dupdate!');
        }
        else{
            return redirect()->route('user.pinjaman')->with('success', 'Pinjaman berhasil dupdate!');}
    }
    
    public function destroy($id)
    {
        // Mencari pinjaman berdasarkan ID
        $pinjaman = Pinjaman::find($id);

        // Menghapus pinjaman
        $pinjaman->delete();

        // Mengalihkan ke halaman daftar pinjaman dengan pesan sukses
        return redirect()->route('pinjaman.index')->with('success', 'Pinjaman berhasil dihapus!');
    }

}

