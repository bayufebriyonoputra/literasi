<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TugasLiterasi;
use App\Models\WargaKelas;

class TugasController extends Controller
{
    public function ekstensif()
    {
        $kelas = WargaKelas::where('siswa_id', auth()->guard('siswa')->user()->id)->first();
        // return $kelas->kelas->tingkat;
        if (!$kelas) {
            abort(404, 'Anda Belum Terdaftar Di kelas hubungi administrator');
        }

        $tugas = TugasLiterasi::where('kelas_id', $kelas->kelas_id)
            ->get();
        $tugas = $tugas->where('jenis_tugas', 'Ekstensif');

        $tugas2 = TugasLiterasi::where('jenis_tugas', 'Ekstensif')
            ->whereIn('tingkat', [$kelas->kelas->tingkat, 'all'])->get();
        $tugas = $tugas->merge($tugas2);

        return view('siswa.tugas.ekstensif', [
            'tugas' => $tugas
        ]);
    }

    public function kerohanian()
    {
        $kelas = WargaKelas::where('siswa_id', auth()->guard('siswa')->user()->id)->first();
        if (!$kelas) {
            abort(404, 'Anda Belum Terdaftar Di kelas hubungi administrator');
        }
        $tugas = TugasLiterasi::where('kelas_id', $kelas->kelas_id)
            ->get();
        $tugas = $tugas->where('jenis_tugas', 'Kerohanian');
        $tugas2 = TugasLiterasi::where('jenis_tugas', 'Kerohanian')
            ->whereIn('tingkat', [$kelas->kelas->tingkat, 'all'])->get();
        $tugas = $tugas->merge($tugas2);

        return view('siswa.tugas.kerohanian', [
            'tugas' => $tugas
        ]);
    }

    public function kunjungan()
    {
        $kelas = WargaKelas::where('siswa_id', auth()->guard('siswa')->user()->id)->first();
        if (!$kelas) {
            abort(404, 'Anda Belum Terdaftar Di kelas hubungi administrator');
        }
        $tugas = TugasLiterasi::where('kelas_id', $kelas->kelas_id)
            ->get();
        $tugas = $tugas->where('jenis_tugas', 'Kunjungan');
        $tugas2 = TugasLiterasi::where('jenis_tugas', 'Kunjungan')
            ->whereIn('tingkat', [$kelas->kelas->tingkat, 'all'])->get();
        $tugas = $tugas->merge($tugas2);

        return view('siswa.tugas.kunjungan', [
            'tugas' => $tugas
        ]);
    }

    public function ukbi()
    {
        $kelas = WargaKelas::where('siswa_id', auth()->guard('siswa')->user()->id)->first();
        if (!$kelas) {
            abort(404, 'Anda Belum Terdaftar Di kelas hubungi administrator');
        }
        $tugas = TugasLiterasi::where('kelas_id', $kelas->kelas_id)
            ->get();
        $tugas = $tugas->where('jenis_tugas', 'UKBI');
        $tugas2 = TugasLiterasi::where('jenis_tugas', 'UKBI')
            ->whereIn('tingkat', [$kelas->kelas->tingkat, 'all'])->get();
        $tugas = $tugas->merge($tugas2);

        return view('siswa.tugas.ukbi', [
            'tugas' => $tugas
        ]);
    }


    public function karya()
    {
        $kelas = WargaKelas::where('siswa_id', auth()->guard('siswa')->user()->id)->first();
        if (!$kelas) {
            abort(404, 'Anda Belum Terdaftar Di kelas hubungi administrator');
        }
        $tugas = TugasLiterasi::where('kelas_id', $kelas->kelas_id)
            ->get();
        $tugas = $tugas->where('jenis_tugas', 'Karya');
        $tugas2 = TugasLiterasi::where('jenis_tugas', 'Karya')
            ->whereIn('tingkat', [$kelas->kelas->tingkat, 'all'])->get();
        $tugas = $tugas->merge($tugas2);
        return view('siswa.tugas.karya', [
            'tugas' => $tugas
        ]);
    }
}
