<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('pengaudan');
    }

    public function store(Request $request)
    {
        $pengaduan = Pengaduan::create([
            'tanggal' => now(),
            'email' => $request->email,
            'pengaduan' => $request->pengaduan
        ]);

        if ($pengaduan) return redirect()->back()->with('success', 'Pengaduan Berhasil Dibuat');
        return redirect()->back()->with('error', 'Pengaduan Gagal, Silahkan Coba Lagi');
    }
}
