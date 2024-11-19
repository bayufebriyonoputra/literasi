<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tempat;
use App\Rules\wordCount;
use Exception;
use Illuminate\Support\Facades\Storage;

class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kunjungan = Kunjungan::where('siswa_id', auth()->guard('siswa')->user()->id)->get();
        return view('siswa.kunjungan.list', [
            'kunjungan' => $kunjungan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tempat = Tempat::all();
        return view('siswa.kunjungan.create', [
            'tempat' => $tempat
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validetData = $request->validate([
            'tanggal' => 'required',
            'profil_pelajar_pancasila' => 'required',
            'keterangan' => ['required', new wordCount(15)],
            'hasil_kunjungan' =>  ['required', new wordCount(50)],
            'nama_tempat' => 'required|min:5',
            'tempat_id' => 'required',
            'file_foto' => 'required|image|mimes:jpeg,png,jpg|max:1048'
        ]);

        $validetData['siswa_id'] = auth()->guard('siswa')->user()->id;
        $validetData['tahun_pelajaran'] = getAcademicYear(now());
        $validetData['file_foto'] = Storage::disk('public_uploads')->put('foto kunjungan', $request->file('file_foto'));

        Kunjungan::create($validetData);
        return back()->with('success', 'Data telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kunjungan  $kunjungan
     * @return \Illuminate\Http\Response
     */
    public function show(Kunjungan $kunjungan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kunjungan  $kunjungan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kunjungan $kunjungan)
    {
        return view('siswa.kunjungan.edit', [
            'kunjungan' => $kunjungan,
            'tempat' => Tempat::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kunjungan  $kunjungan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kunjungan $kunjungan)
    {
        $validetData = $request->validate([
            'tanggal' => 'required',
            'profil_pelajar_pancasila' => 'required',
            'keterangan' => ['required', new wordCount(50)],
            'hasil_kunjungan' => ['required', new wordCount(200)],
            'nama_tempat' => 'required|min:5',
            'tempat_id' => 'required'
        ]);

        if ($request->file_foto) {
            $validetData['file_foto'] = Storage::disk('public_uploads')->put('foto kunjungan', $request->file('file_foto'));

            unlink('uploads/' . $kunjungan->file_foto);
        }

        Kunjungan::where('id', $kunjungan->id)
            ->update($validetData);
        return redirect()->back()->with('success', 'Data telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kunjungan  $kunjungan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kunjungan $kunjungan)
    {
        $path = 'uploads/' . $kunjungan->file_foto;
        unlink($path);
        $kunjungan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
