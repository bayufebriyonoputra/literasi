<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kerohanian;

class KerohanianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rohani = Kerohanian::where('siswa_id', auth()->guard('siswa')->user()->id)->with('dataKerohanian')->get();
        return view('siswa.kerohanian.list', [
            'rohani' => $rohani
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.kerohanian.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kerohanian = Kerohanian::where('siswa_id', auth()->guard('siswa')->user()->id)->where('tanggal', now()->toDateString())->get();
        if ($kerohanian->count() >= 2) {

            return redirect()->back()->with('error', 'Maaf Anda Hanya Bisa Input 2 Kali Dalam 1 Hari');
        }

        $validatedData = $request->validate([
            'tanggal' => 'required',
            'durasi' => 'required',
            'agama' => 'required',
            'data_kerohanian_id' => 'required',
            'laporan_kegiatan' => 'required'
        ]);
        $validatedData['siswa_id'] = auth()->guard('siswa')->user()->id;

        $not = Kerohanian::create($validatedData);
        if ($not)  return back()->with('success', 'Data berhasil ditambahkan');

        return back()->with('error', 'Data Gagal ditambahkan');
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
    public function edit(Kerohanian $kerohanian)
    {
        return view('siswa.kerohanian.edit', [
            'kerohanian' => $kerohanian
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kerohanian)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'durasi' => 'required',
            'agama' => 'required',
            'data_kerohanian_id' => 'required',
            'laporan_kegiatan' => 'required'
        ]);
        Kerohanian::where('id', $kerohanian)
            ->update($validatedData);
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kerohanian $kerohanian)
    {
        $kerohanian->delete();
        return redirect()->back()->with('success', 'Data telah dihapus');
    }
}
