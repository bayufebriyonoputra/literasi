<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class WaliKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Guru::all();
        $kelas = Kelas::all();
        $walas = WaliKelas::with(['guru', 'kelas'])->get();
        return view('admin.walas.list', [
            'walas' => $walas,
            'guru' => $guru,
            'kelas' => $kelas
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
        $data = WaliKelas::where('guru_id', $request->input('guru_id'))->get();
        $data  = $data->pluck('tahun_pelajaran')->toArray();

        if (in_array($request->input('tahun_pelajaran'), $data)) {
            $validatedData = $request->validate(
                [
                    'kelas_id' => ['required', 'unique:wali_kelas,kelas_id'],
                    'guru_id' => ['required', 'unique:wali_kelas,guru_id'],
                    'tahun_pelajaran' => 'required'
                ],
                [
                    'guru_id.unique' => 'Wali Kelas Terdaftar Pada Tahun Pelajaran Yang Sama'
                ]
            );
        } else {
            $validatedData =  $request->validate([
                'kelas_id' => 'required',
                'guru_id' => 'required',
                'tahun_pelajaran' => 'required'
            ]);
        }

        Guru::where('id', $request->guru_id)->update([
            'walas' => true
        ]);

        WaliKelas::create($validatedData);
        return back()->with('success', 'Data ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaliKelas  $waliKelas
     * @return \Illuminate\Http\Response
     */
    public function show(WaliKelas $admin_wala)
    {
        return $admin_wala;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaliKelas  $waliKelas
     * @return \Illuminate\Http\Response
     */
    public function edit(WaliKelas $waliKelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WaliKelas  $waliKelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WaliKelas $waliKelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaliKelas  $waliKelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaliKelas $admin_wala)
    {
        Guru::where('id', $admin_wala->guru_id)->update([
            'walas' => false
        ]);

        WaliKelas::where('id', $admin_wala->id)
            ->delete();
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
