<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ekstensif;
use App\Rules\wordCount;

class EkstensifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ekstensif = Ekstensif::where('siswa_id', auth()->guard('siswa')->user()->id)->get();
        return view('siswa.ekstensif.list', [
            'ekstensif' => $ekstensif
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.ekstensif.create');
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
            'tanggal' => 'required',
            'durasi' => 'required|numeric',
            'isbn' => 'required|numeric',
            'judul_buku' => 'required|min:6',
            'jumlah_halaman' => 'required',
            'rangkuman' => ['required', new wordCount(100)]
        ]);
        $validatedData['siswa_id'] = auth()->guard('siswa')->user()->id;
        $eks = Ekstensif::create($validatedData);
        if ($eks) return back()->with('success', 'Data berhasil ditambahkan');

        return back()->with('error', 'Terdapat kesalahan silahkan coba beberapa saat kembali');
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
    public function edit(Ekstensif $ekstensif)
    {
        return view('siswa.ekstensif.edit', [
            'ekstensif' => $ekstensif
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Ekstensif $ekstensif, Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'durasi' => 'required|numeric',
            'isbn' => 'required|numeric',
            'judul_buku' => 'required|min:6',
            'jumlah_halaman' => 'required',
            'rangkuman' => ['required', new wordCount(100)]
        ]);
        Ekstensif::where('id', $ekstensif->id)->update($validatedData);
        return redirect()->back()->with('success', 'Data telah diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ekstensif $ekstensif)
    {
        $ekstensif->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
