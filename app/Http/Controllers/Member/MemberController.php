<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // Display the dashboard view
    public function index()
    {
        return view('member.dashboard');
    }

    // Display the transaksi view
    public function transaksi()
    {
        return view('member.transaksi');
    }

    // Display all simpanan records
    public function simpanan()
    {
        $simpanan = Simpanan::all(); // Fetch all simpanan data from the table
        return view('member.simpanan.index', compact('simpanan'));
    }

    // Display all pinjaman records
    public function pinjaman()
    {
        $pinjaman = Pinjaman::all(); // Fetch all pinjaman data from the table
        return view('member.pinjaman.index', compact('pinjaman'));
    }
}
