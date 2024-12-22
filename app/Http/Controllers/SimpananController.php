<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Simpanan;
    use App\Models\Transaksi;
    use Illuminate\Support\Facades\Auth;

    class SimpananController extends Controller
    {
        // Menampilkan data simpanan dan histori transaksi
        public function index()
        {
            // Ambil semua transaksi terkait user yang sedang login
            $transaksi = Transaksi::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        
            // Hitung total simpanan user
            $totalSimpanan = Simpanan::where('user_id', Auth::id())->sum('total_simpanan');
        
            // Kirimkan data ke view
            return view('member.simpanan.index', compact('transaksi', 'totalSimpanan'));
        }
        
        
        

        public function transaksi()
        {
            // Mengambil data transaksi dengan paginasi
            $transaksi = Transaksi::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        
            // Hitung total simpanan menggunakan metode totalSimpanan
            $totalSimpanan = $this->totalSimpanan();
        
            return view('member.simpanan.transaksi', compact('transaksi', 'totalSimpanan'));
        }
        
        
        
        // Proses setor simpanan
        public function setor(Request $request)
        {
            // Validasi input jumlah setor
            $request->validate([
                'jumlah' => 'required|numeric|min:1',
            ]);
        
            // Mengambil atau membuat simpanan baru untuk user
            $simpanan = Simpanan::firstOrCreate(
                ['user_id' => Auth::id()],
                ['total_simpanan' => 0]  // Set default jika belum ada simpanan
            );
        
            // Menambahkan jumlah setor ke total simpanan
            $simpanan->increment('total_simpanan', $request->jumlah);
        
            // Mencatat transaksi setor
            Transaksi::create([
                'simpanan_id' => $simpanan->id,
                'user_id' => Auth::id(),
                'jumlah' => $request->jumlah,
                'jenis_transaksi' => 'setoran',
            ]);
        
            // Ambil data terbaru untuk transaksi dan total simpanan
            $transaksi = Transaksi::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        
            $totalSimpanan = $simpanan->total_simpanan;
        
            // Redirect kembali ke view dengan data terbaru
            return redirect()->route('member.simpanan.index')
                ->with(['transaksi' => $transaksi, 'totalSimpanan' => $totalSimpanan])
                ->with('success', 'Setoran berhasil ditambahkan!');
        }
        
        // Proses tarik simpanan
        public function tarik(Request $request)
        {
            // Validasi input jumlah tarik
            $request->validate([
                'jumlah' => 'required|numeric|min:1',
            ]);
        
            // Mengambil simpanan milik user
            $simpanan = Simpanan::where('user_id', Auth::id())->first();
        
            // Mengecek apakah simpanan ada dan saldo cukup untuk penarikan
            if (!$simpanan || $simpanan->total_simpanan < $request->jumlah) {
                return redirect()->back()->with('error', 'Saldo tidak mencukupi untuk penarikan!');
            }
        
            // Mengurangi jumlah tarik dari total simpanan
            $simpanan->decrement('total_simpanan', $request->jumlah);
        
            // Mencatat transaksi penarikan
            Transaksi::create([
                'simpanan_id' => $simpanan->id,
                'user_id' => Auth::id(),
                'jumlah' => $request->jumlah,
                'jenis_transaksi' => 'penarikan',
            ]);
        
            // Ambil data terbaru untuk transaksi dan total simpanan
            $transaksi = Transaksi::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        
            $totalSimpanan = $simpanan->total_simpanan;
        
            // Redirect kembali ke view dengan data terbaru
            return redirect()->route('member.simpanan.index')
                ->with(['transaksi' => $transaksi, 'totalSimpanan' => $totalSimpanan])
                ->with('success', 'Penarikan berhasil dilakukan!');
        }
        
        public function totalSimpanan()
        {
            // Ambil data simpanan pengguna saat ini
            $simpanan = Simpanan::where('user_id', Auth::id())->first();
        
            if ($simpanan) {
                // Hitung total setoran
                $totalSetoran = Transaksi::where('user_id', Auth::id())
                                        ->where('jenis_transaksi', 'setoran')
                                        ->sum('jumlah');
        
                // Hitung total penarikan
                $totalTarik = Transaksi::where('user_id', Auth::id())
                                      ->where('jenis_transaksi', 'penarikan')
                                      ->sum('jumlah');
        
                // Hitung total simpanan: saldo awal + setoran - penarikan
                $totalSimpanan = $simpanan->total_simpanan + $totalSetoran - $totalTarik;
        
                // Kembalikan hasil
                return $totalSimpanan;
            }
        
            // Jika simpanan tidak ditemukan, kembalikan 0
            return 0;
        }
        
    }
