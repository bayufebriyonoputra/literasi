<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Siswa;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::all();
        return view('admin.siswa.list', [
            'siswa' => $siswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.siswa.create');
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
            'tahun_masuk' => 'required|max:4',
            'nomor_induk' => 'required|numeric|unique:siswas,nomor_induk',
            'nama' => 'required|min:5',
            'alamat' => 'required|min:15',
            'jenis_kelamin' => 'required',
            'nama_wali' => 'required|min:5',
            'hp_siswa' => 'required|min:11|unique:siswas,hp_siswa|max:14',
            'hp_wali' => 'required|min:11|unique:siswas,hp_wali|max:14',
            'tes_diagnostik' => 'required',
            'tahun_pelajaran' => 'required'
        ]);

        $validatedData['password'] = bcrypt($request->nomor_induk);

        Siswa::create($validatedData);

        return back()->with('success', 'Data berhasil Ditambahkan');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
