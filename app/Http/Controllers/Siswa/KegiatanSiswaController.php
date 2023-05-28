<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KegiatanSiswa;
use Illuminate\Support\Facades\Storage;

class KegiatanSiswaController extends Controller
{

    public function create()
    {
        return view('siswa.kegiatan.create');
    }

    public function store(Request $request)
    {
        $siswa_id = auth()->guard('siswa')->user()->id;
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'nama_kegiatan' => 'required',
            'deskripsi' => 'required|min:15',
            'foto' => 'image|required|mimes:jpeg,png,jpg|max:2048'
        ]);

        $validatedData['foto'] = Storage::disk('public_uploads')->put('Foto_Kegiatan', $request->file('foto'));
        $validatedData['siswa_id'] = $siswa_id;
        KegiatanSiswa::create($validatedData);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function list()
    {
        $kegiatan = KegiatanSiswa::where('siswa_id', auth()->guard('siswa')->user()->id)->get();
        return view('siswa.kegiatan.list', [
            'kegiatan' => $kegiatan
        ]);
    }

    public function destroy(KegiatanSiswa $kegiatan)
    {
        unlink('uploads/' . $kegiatan->foto);
        $kegiatan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function edit(KegiatanSiswa $kegiatan)
    {
        return view('siswa.kegiatan.edit', [
            'kegiatan' => $kegiatan
        ]);
    }

    public function update(KegiatanSiswa $kegiatan, Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'nama_kegiatan' => 'required',
            'deskripsi' => 'required|min:15',
        ]);
        if ($request->foto) {
            unlink('uploads/' . $kegiatan->foto);
            $validatedData['foto'] = Storage::disk('public_uploads')->put('Foto_Kegiatan', $request->file('foto'));
        }
        KegiatanSiswa::where('id', $kegiatan->id)
            ->update($validatedData);
        return redirect()->back()->with('success', 'Data diubah');
    }
}
