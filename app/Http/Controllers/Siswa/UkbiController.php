<?php

namespace App\Http\Controllers\Siswa;

use App\Models\UKBI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UkbiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ukbi = UKBI::where('siswa_id', auth()->guard('siswa')->user()->id)->get();
        return view('siswa.UKBI.list', [
            'ukbi' => $ukbi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.UKBI.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'siswa_id' => auth()->guard('siswa')->user()->id,
            'tanggal_tes' => $request->tanggal,
            'skor' => $request->skor,
            'sertifikat' => Storage::disk('public_uploads')->put('foto karya', $request->file('sertifikat')),
            'tahun_pelajaran' => getAcademicYear(now())

        ];
        UKBI::create($data);
        return back()->with('success', 'Sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UKBI  $uKBI
     * @return \Illuminate\Http\Response
     */
    public function show(UKBI $uKBI)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UKBI  $uKBI
     * @return \Illuminate\Http\Response
     */
    public function edit(UKBI $ukbi)
    {
        return view('siswa.UKBI.edit', [
            'ukbi' => $ukbi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UKBI  $uKBI
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UKBI $ukbi)
    {
        $data = [
            'tanggal_tes' => $request->tanggal,
            'skor' => $request->skor,


        ];
        if ($request->sertifikat) {
            unlink('uploads/' . $ukbi->sertifikat);
            $data['sertifikat'] =  Storage::disk('public_uploads')->put('foto karya', $request->file('sertifikat'));
        }

        UKBI::where('id', $ukbi->id)
            ->update($data);
        return redirect()->back()->with('success', 'Data telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UKBI  $uKBI
     * @return \Illuminate\Http\Response
     */
    public function destroy(UKBI $ukbi)
    {
        unlink('uploads/' . $ukbi->sertifikat);
        $ukbi->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
