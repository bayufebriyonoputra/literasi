<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\DataKerohanian;
use App\Http\Controllers\Controller;

class DataKerohanianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rohani = DataKerohanian::all();
        return view('admin.data_kerohanian.list', [
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
        return view('admin.data_kerohanian.create');
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
            'agama' => 'required',
            'kegiatan' => 'required',
            'target' => 'required|numeric'
        ]);


        $dat = DataKerohanian::create($validatedData);
        if ($dat) return back()->with('success', 'Data berhasil ditambahkan');

        return back()->with('error', 'Terjadi kesalahan silahkan coba beberapa saat lagi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataKerohanian  $dataKerohanian
     * @return \Illuminate\Http\Response
     */
    public function show(DataKerohanian $dataKerohanian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataKerohanian  $dataKerohanian
     * @return \Illuminate\Http\Response
     */
    public function edit(DataKerohanian $data_kerohanian)
    {
        return view('admin.data_kerohanian.edit', [
            'rohani' => $data_kerohanian
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataKerohanian  $dataKerohanian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataKerohanian $data_kerohanian)
    {
        $validatedData = $request->validate([
            'agama' => 'required',
            'kegiatan' => 'required',
            'target' => 'required|numeric'
        ]);

        $data_kerohanian->update($validatedData);
        return back()->with('success', 'Data behasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataKerohanian  $dataKerohanian
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataKerohanian $data_kerohanian)
    {
        $data_kerohanian->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
