<?php

namespace App\Http\Controllers\Admin;

use App\Models\Karya;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class KaryaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karya = Karya::all();
        return view('admin.karya.list', [
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
        return view('admin.karya.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Karya::create([
            'karya' => $request->karya
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karya  $karya
     * @return \Illuminate\Http\Response
     */
    public function show(Karya $karya)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karya  $karya
     * @return \Illuminate\Http\Response
     */
    public function edit(Karya $karya)
    {
        return view('admin.karya.edit', [
            'karya' => $karya
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karya  $karya
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karya $karya)
    {
        $karya->update([
            'karya' => $request->karya
        ]);
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karya  $karya
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karya $karya)
    {
        $karya->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
