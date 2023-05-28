<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Guru;

class TimLiterasiController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        $literasi = Guru::where('inovasi', true)->get();

        return view('admin.tim_literasi.list', [
            'guru' => $guru,
            'literasi' => $literasi
        ]);
    }

    public function add(Request $request)
    {
        Guru::where('id', $request->guru_id)
            ->update([
                'admin' => false,
                'walas' => false,
                'perpustakaan' => false,
                'inovasi' => true
            ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function remove($tim_literasi)
    {
        Guru::where('id', $tim_literasi)
            ->update([
                'admin' => false,
                'walas' => false,
                'inovasi' => false,
                'perpustkaan' => false
            ]);

        return back()->with('success', 'Data berhasil dihapus');
    }
}
