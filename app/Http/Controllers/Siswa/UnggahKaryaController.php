<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Karya;
use App\Models\UnggahKarya;
use Illuminate\Support\Facades\Storage;

class UnggahKaryaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karya = UnggahKarya::where('siswa_id', auth()->guard('siswa')->user()->id)->get();
        return view('siswa.unggah_karya.list', [
            'karya' => $karya
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $karya = Karya::all();
        return view('siswa.unggah_karya.create', [
            'karya' => $karya
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

        $data = [
            'tanggal' => $request->tanggal,
            'siswa_id' => auth()->guard('siswa')->user()->id,
            'karya_id' => $request->karya_id,
            'file_karya' => Storage::disk('public_uploads')->put('File Karya', $request->file_karya),
            'status_kurasi' => 'Belum Di Kurasi',
            'tahun_pelajaran' => getAcademicYear(now())

        ];

        UnggahKarya::create($data);
        return back()->with('success', 'Data ditambahkan');
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
    public function edit(UnggahKarya $unggah_karya)
    {

        return view('siswa.unggah_karya.edit', [
            'unggah' => $unggah_karya,
            'karya' => Karya::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $unggah_karya)
    {
        $data = [
            'siswa_id' => auth()->guard('siswa')->user()->id,
            'karya_id' => $request->karya_id,
            'status_kurasi' => 'Belum Di Kurasi',

        ];
        if ($request->file_karya) {
            $data['file_karya'] =  Storage::disk('public_uploads')->put('File Karya', $request->file_karya);
            unlink('uploads/' . $request->file_karya);
        }
        UnggahKarya::where('id', $unggah_karya)
            ->update($data);
        return redirect()->back()->with('success', 'Data Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnggahKarya $unggah_karya)
    {
        unlink('uploads/' . $unggah_karya->file_karya);
        $unggah_karya->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
