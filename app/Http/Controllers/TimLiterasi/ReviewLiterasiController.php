<?php

namespace App\Http\Controllers\TimLiterasi;

use Illuminate\Http\Request;
use App\Models\ReviewLiterasi;
use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\WaliKelas;

class ReviewLiterasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review = ReviewLiterasi::all();
        return view('tim_literasi.review.list', [
            'review' => $review
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $guru_id = WaliKelas::all();
        $guru_id = $guru_id->pluck('guru_id');
        $walas = Guru::whereIn('id', $guru_id)->get();
        return view('tim_literasi.review.create', [
            'walas' => $walas
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
        $data = [];
        if ($request->wali_kelas_id == 'none') {
            $data = [
                'guru_id' => auth()->guard('guru')->user()->id,
                'tanggal' => $request->tanggal,
                'review' => $request->review
            ];
        } else {
            $data = [
                'guru_id' => auth()->guard('guru')->user()->id,
                'tanggal' => $request->tanggal,
                'review' => $request->review,
                'wali_kelas_id' => $request->wali_kelas_id
            ];
        }

        ReviewLiterasi::create($data);
        return back()->with('success', 'Review Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReviewLiterasi  $reviewLiterasi
     * @return \Illuminate\Http\Response
     */
    public function show(ReviewLiterasi $reviewLiterasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReviewLiterasi  $reviewLiterasi
     * @return \Illuminate\Http\Response
     */
    public function edit(ReviewLiterasi $review_literasi)
    {
        $guru_id = WaliKelas::all();
        $guru_id = $guru_id->pluck('guru_id');
        $walas = Guru::whereIn('id', $guru_id)->get();
        return view('tim_literasi.review.edit', [
            'review' => $review_literasi,
            'walas' => $walas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReviewLiterasi  $reviewLiterasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReviewLiterasi $review_literasi)
    {
        $data = [];
        if ($request->wali_kelas_id == 'none') {
            $data = [
                'guru_id' => auth()->guard('guru')->user()->id,
                'tanggal' => $request->tanggal,
                'review' => $request->review
            ];
        } else {
            $data = [
                'guru_id' => auth()->guard('guru')->user()->id,
                'tanggal' => $request->tanggal,
                'review' => $request->review,
                'wali_kelas_id' => $request->wali_kelas_id
            ];
        }

        ReviewLiterasi::where('id', $review_literasi->id)
            ->update($data);
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReviewLiterasi  $reviewLiterasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReviewLiterasi $review_literasi)
    {
        $review_literasi->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
