<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataKerohanian;
use App\Models\Kerohanian;

class ApiKerohanianController extends Controller
{
    public function kegiatan(Request $request)
    {
        $rohani = DataKerohanian::where('agama', $request->agama)->get();
        $rohani = $rohani->pluck('kegiatan', 'id');

        return $rohani;
    }
}
