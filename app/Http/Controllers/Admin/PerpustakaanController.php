<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Guru;

class PerpustakaanController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        $perpus = Guru::where('perpustakaan', true)->get();

        return view('admin.perpustakaan.list', [
            'guru' => $guru,
            'perpus' => $perpus
        ]);
    }

    public function add(Request $request)
    {
        Guru::where('id', $request->guru_id)
            ->update([
                'admin' => false,
                'walas' => false,
                'perpustakaan' => true,
                'inovasi' => false
            ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function remove($perpustakaan)
    {
        Guru::where('id', $perpustakaan)
            ->update([
                'admin' => false,
                'walas' => false,
                'perpustakaan' => false,
                'inovasi' => false
            ]);

        return back()->with('success', 'Data berhasil dihapus');
    }
}
