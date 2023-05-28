<?php

namespace App\Http\Controllers\TimLiterasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Perpustakaan;
use Illuminate\Support\Facades\Storage;

class PerpustakaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Perpustakaan::all();
        return view('tim_literasi.perpus.list', [
            'buku' => $buku
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tim_literasi.perpus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'isbn' => 'required|unique:perpustakaans,isbn',
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'sinopsis' => 'required|max:225',
            'cover_buku' => 'image|required|mimes:jpeg,png,jpg|max:2048',
            'file_buku' => 'required|mimes:pdf,max:10000'
        ]);

        //
        $validatedData['cover_buku'] = Storage::disk('public_uploads')->put('Cover-Buku', $request->file('cover_buku'));
        $validatedData['file_buku'] = Storage::disk('public_uploads')->put('File-Buku', $request->file('file_buku'));

        Perpustakaan::create($validatedData);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Perpustakaan $perpustakaan)
    {
        return view('tim_literasi.perpus.edit', [
            'buku' => $perpustakaan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Perpustakaan $perpustakaan, Request $request)
    {
        $validatedData = $request->validate([
            'isbn' => 'required',
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'sinopsis' => 'required|max:225',
            'cover_buku' => 'image|required|mimes:jpeg,png,jpg|max:2048',
            'file_buku' => 'required|mimes:pdf,max:10000'
        ]);

        unlink('uploads/' . $perpustakaan->cover_buku);
        unlink('uploads/' . $perpustakaan->file_buku);
        $validatedData['cover_buku'] = Storage::disk('public_uploads')->put('Cover-Buku', $request->file('cover_buku'));
        $validatedData['file_buku'] = Storage::disk('public_uploads')->put('File-Buku', $request->file('file_buku'));
        Perpustakaan::where('id', $perpustakaan->id)
            ->update($validatedData);

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perpustakaan $perpustakaan)
    {
        $perpustakaan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
