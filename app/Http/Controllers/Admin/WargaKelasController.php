<?php

namespace App\Http\Controllers\Admin;

use App\Models\WargaKelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\WaliKelas;

class WargaKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warga_kelas = WargaKelas::all();
        $wali_kelas = WaliKelas::all();
        return view('admin.warga_kelas.list', [
            'warga_kelas' => $warga_kelas,
            'wali_kelas' => $wali_kelas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'kelas_id' => 'required',
            'siswa_id' => 'required',
            'wali_kelas_id' => 'required',
            'tahun_pelajaran' => 'required'
        ]);

        WargaKelas::create($validatedData);
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WargaKelas  $wargaKelas
     * @return \Illuminate\Http\Response
     */
    public function show(WaliKelas $admin_warga)
    {
        $warga_kelas =  WargaKelas::where('kelas_id', $admin_warga->kelas_id)
            ->where('wali_kelas_id', $admin_warga->guru_id)
            ->where('tahun_pelajaran', $admin_warga->tahun_pelajaran)
            ->get();


        $nama_kelas = $admin_warga->kelas->nama_kelas;

        $siswa = Siswa::all();


        return view('admin.warga_kelas.edit_warga_kelas', [
            'nama_kelas' => $nama_kelas,
            'warga_kelas' => $warga_kelas,
            'siswa' => $siswa,
            'wali_kelas' => $admin_warga
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WargaKelas  $wargaKelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $admin_warga)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WargaKelas  $wargaKelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WargaKelas $wargaKelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WargaKelas  $wargaKelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(WargaKelas $admin_warga)
    {
        WargaKelas::where('id', $admin_warga->id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
