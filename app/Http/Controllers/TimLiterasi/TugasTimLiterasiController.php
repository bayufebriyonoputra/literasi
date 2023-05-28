<?php

namespace App\Http\Controllers\TimLiterasi;

use App\Models\Kelas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TugasLiterasi;
use App\Http\Controllers\Controller;

class TugasTimLiterasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tugas = TugasLiterasi::orderBy('tanggal', 'DESC')->get();
        return view('tim_literasi.tugas.list', [
            'tugas' => $tugas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $kelas = Kelas::all();
        $tingkat = [];
        for ($i = 0; $i < $kelas->count(); $i++) {
            if (in_array($kelas[$i]->tingkat, $tingkat)) {
                continue;
            }
            array_push($tingkat, $kelas[$i]->tingkat);
        }
        $tingkat = collect($tingkat);
        return view('tim_literasi.tugas.create', [
            'kelas' => $kelas,
            'tingkat' => $tingkat
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

        if (Str::contains($request->kelas_id, ['Tingkat', 'all'])) {


            if ($request->kelas_id == 'all') {

                $data = [
                    'guru_id' => auth()->guard('guru')->user()->id,
                    'tanggal' => $request->tanggal,
                    'tingkat' => $request->kelas_id,
                    'tugas' => $request->tugas,
                    'keterangan' => $request->keterangan,
                    'jenis_tugas' => $request->jenis_tugas
                ];
            } else {
                $data = [
                    'guru_id' => auth()->guard('guru')->user()->id,
                    'tanggal' => $request->tanggal,
                    'tingkat' => (int) filter_var($request->kelas_id, FILTER_SANITIZE_NUMBER_INT),
                    'tugas' => $request->tugas,
                    'keterangan' => $request->keterangan,
                    'jenis_tugas' => $request->jenis_tugas
                ];
            }
        } else {
            $data = [
                'guru_id' => auth()->guard('guru')->user()->id,
                'tanggal' => $request->tanggal,
                'kelas_id' => $request->kelas_id,
                'tugas' => $request->tugas,
                'keterangan' => $request->keterangan,
                'jenis_tugas' => $request->jenis_tugas
            ];
        }


        TugasLiterasi::create($data);
        return back()->with('success', "Transaksi Berhasil");
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
    public function edit(TugasLiterasi $tugas_literasi)
    {
        $kelas = Kelas::all();
        $tingkat = [];
        for ($i = 0; $i < $kelas->count(); $i++) {
            if (in_array($kelas[$i]->tingkat, $tingkat)) {
                continue;
            }
            array_push($tingkat, $kelas[$i]->tingkat);
        }
        $tingkat = collect($tingkat);
        return view('tim_literasi.tugas.edit', [
            'tugas' => $tugas_literasi,
            'kelas' => $kelas,
            'tingkat' => $tingkat
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TugasLiterasi $tugas_literasi, Request $request)
    {
        if (Str::contains($request->kelas_id, ['Tingkat', 'all'])) {


            if ($request->kelas_id == 'all') {

                $data = [
                    'guru_id' => auth()->guard('guru')->user()->id,
                    'tanggal' => $request->tanggal,
                    'tingkat' => $request->kelas_id,
                    'tugas' => $request->tugas,
                    'keterangan' => $request->keterangan,
                    'jenis_tugas' => $request->jenis_tugas
                ];
            } else {
                $data = [
                    'guru_id' => auth()->guard('guru')->user()->id,
                    'tanggal' => $request->tanggal,
                    'tingkat' => (int) filter_var($request->kelas_id, FILTER_SANITIZE_NUMBER_INT),
                    'tugas' => $request->tugas,
                    'keterangan' => $request->keterangan,
                    'jenis_tugas' => $request->jenis_tugas
                ];
            }
        } else {
            $data = [
                'guru_id' => auth()->guard('guru')->user()->id,
                'tanggal' => $request->tanggal,
                'kelas_id' => $request->kelas_id,
                'tugas' => $request->tugas,
                'keterangan' => $request->keterangan,
                'jenis_tugas' => $request->jenis_tugas
            ];
        }
        TugasLiterasi::where('id', $tugas_literasi->id)
            ->update($data);
        return redirect()->back()->with('success', 'Data telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tugas_literasi)
    {
        TugasLiterasi::where('id', $tugas_literasi)
            ->delete();

        return redirect()->back()->with('success', 'Data telah dihapus');
    }
}
