<?php

namespace App\Http\Controllers\Perpustakaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KegiatanPerpustakaan;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class GeneralPerpustakaanController extends Controller
{
    public function index()
    {
        return view('perpustakaan.main');
    }

    public function create()
    {
        return view('perpustakaan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'nama_kegiatan' => 'required',
            'deskripsi' => 'required|min:15',
            'foto' => 'image|required|mimes:jpeg,png,jpg|max:2048'
        ]);

        $image = $request->file('foto');
        $filename = time() . '.' . $request->foto->extension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->fit(600, 360);
        $image_resize->save(public_path('uploads/Foto_Kegiatan/' . $filename));

        $validatedData['foto'] = 'Foto_Kegiatan/' . $filename;
        KegiatanPerpustakaan::create($validatedData);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function list()
    {
        $kegiatan = KegiatanPerpustakaan::all();
        return view('perpustakaan.list', [
            'kegiatan' => $kegiatan
        ]);
    }

    public function remove($id)
    {
        $perpus = KegiatanPerpustakaan::where('id', $id)->first();
        $file_path = 'uploads/' . $perpus->foto;
        unlink($file_path);
        $perpus->delete();


        if ($perpus) return redirect()->back()->with('success', "Data Berhasil Dihapus");
        return redirect()->back()->with('error', 'Data Gagal Dihapus');
    }

    public function edit(KegiatanPerpustakaan $kegiatan)
    {
        return view('perpustakaan.edit', [
            'kegiatan' => $kegiatan
        ]);
    }

    public function update(KegiatanPerpustakaan $kegiatan, Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'nama_kegiatan' => 'required',
            'deskripsi' => 'required|min:15',
            'foto' => 'image|required|mimes:jpeg,png,jpg|max:2048'
        ]);
        $file_path = 'uploads/' . $kegiatan->foto;
        unlink($file_path);
        $image = $request->file('foto');
        $filename = time() . '.' . $request->foto->extension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->fit(600, 360);
        $image_resize->save(public_path('uploads/Foto_Kegiatan/' . $filename));

        $validatedData['foto'] = 'Foto_Kegiatan/' . $filename;

        KegiatanPerpustakaan::where('id', $kegiatan->id)
            ->update($validatedData);

        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }
}
