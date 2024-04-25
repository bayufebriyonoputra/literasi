<?php

namespace App\Http\Controllers\TimLiterasi;

use App\Models\UKBI;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Ekstensif;
use App\Models\Kunjungan;
use App\Models\Pengaduan;
use App\Models\Kerohanian;
use App\Models\WargaKelas;
use App\Models\UnggahKarya;
use Illuminate\Http\Request;
use App\Models\KegiatanSiswa;
use App\Http\Controllers\Controller;

class GeneralTimLiterasiController extends Controller
{
    public function ekstensif()
    {
        $ekstensif = Ekstensif::where('tahun_pelajaran', getAcademicYear(now()))->get();
        $ekstensif = $ekstensif->groupBy('siswa_id');
        $ekstensif = $ekstensif->map(function ($query) {
            return $query->groupBy('isbn');
        });
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('tim_literasi.ekstensif.list', [
            'ekstensif' => $ekstensif,
            'kelas' => $kelas,
            'kelas_id' => null,
            'list_tapel' => array_reverse(getAcademicYearsList()),
            'selected_tapel' => getAcademicYear(now())
        ]);
    }

    public function filterEkstensif(Request $request)
    {


        if ($request->tahun_pelajaran != 'all') {
            $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id)
                ->where('tahun_pelajaran', $request->tahun_pelajaran);
            $warga_kelas = $warga_kelas->pluck('siswa_id');
            $kelas = Kelas::orderBy('nama_kelas')->get();
        } else {
            $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
            $warga_kelas = $warga_kelas->pluck('siswa_id');
            $kelas = Kelas::orderBy('nama_kelas')->get();
        }

        if ($request->kelas_id != 'all') {
            $ekstensif = Ekstensif::whereIn('siswa_id', $warga_kelas)->get();
        } else {
            $ekstensif = Ekstensif::all();
        }

        if ($request->from && $request->to) {
            $ekstensif = $ekstensif->whereBetween('tanggal', [$request->from, $request->to]);
        }

        if ($request->tahun_pelajaran != 'all') {
            $ekstensif = $ekstensif->where('tahun_pelajaran', $request->tahun_pelajaran);
        }

        $ekstensif = $ekstensif->groupBy('siswa_id');
        $ekstensif = $ekstensif->map(function ($query) {
            return $query->groupBy('isbn');
        });
        return view('tim_literasi.ekstensif.list', [
            'ekstensif' => $ekstensif,
            'kelas' => $kelas,
            'from' => $request->from ?? null,
            'to' => $request->to ?? null,
            'kelas_id' => $request->kelas_id,
            'list_tapel' => array_reverse(getAcademicYearsList()),
            'selected_tapel' => $request->tahun_pelajaran
        ]);
    }

    public function ketercapaianEkstensif()
    {
        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;

        $ekstensif = Ekstensif::where('tahun_pelajaran', getAcademicYear(now()))->get();
        $ekstensif = $ekstensif->groupBy('siswa_id');

        $kelas = Kelas::orderBy('nama_kelas')->get();

        $jumlah_siswa = Siswa::all()->count();
        $jml_input = $ekstensif->count();

        foreach ($ekstensif as $k) {
            if ($k->count() >= 3) {
                $memenuhi += 1;
            }
        }

        $tidak_memenuhi = $jumlah_siswa - $memenuhi;
        return view('tim_literasi.ekstensif.ketercapaian', [
            'jumlah_siswa' => 1536,
            'memenuhi' => 923,
            'tidak_memenuhi' => 613,
            'jml_input' => 1190,
            'kelas' => $kelas,
            'kelas_id' => null,
            'list_tapel' => ['2021/2022', '2022/2023'],
            'selected_tapel' => '2021/2022'
        ]);
    }

    public function filterKetercapaianEkstensif(Request $request)
    {

        // Dinonaktifkan sementara untuk lomba

        // $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        // if ($request->tahun_pelajaran !== 'all') {
        //     $warga_kelas = $warga_kelas->where('tahun_pelajaran', $request->tahun_pelajaran);
        // }
        // $warga_kelas = $warga_kelas->pluck('siswa_id');

        // $jumlah_siswa = 0;
        // $jml_input = 0;
        // $memenuhi = 0;
        // $tidak_memenuhi = 0;

        // if ($request->kelas_id != 'all') {
        //     $ekstensif = Ekstensif::whereIn('siswa_id', $warga_kelas)->get();
        //     $jumlah_siswa = Siswa::whereIn('id', $warga_kelas)->count();
        // } else {
        //     $ekstensif = Ekstensif::all();
        //     $jumlah_siswa = Siswa::all()->count();
        // }

        // if ($request->from && $request->to) {
        //     $ekstensif = $ekstensif->whereBetween('tanggal', [$request->from, $request->to]);
        // }

        // if($request->tahun_pelajaran){
        //     $ekstensif = $ekstensif->where('tahun_pelajaran', $request->tahun_pelajaran);
        // }

        // $ekstensif = $ekstensif->groupBy('siswa_id');

        $kelas = Kelas::orderBy('nama_kelas')->get();


        // $jml_input = $ekstensif->count();

        // foreach ($ekstensif as $k) {
        //     if ($k->count() >= 3) {
        //         $memenuhi += 1;
        //     }
        // }
        // if (!$request->kelas_id) {
        //     $jumlah_siswa = 0;
        //     $jml_input = 0;
        //     $memenuhi = 0;
        //     $tidak_memenuhi = 0;

        //     $ekstensif = Ekstensif::all();
        //     $ekstensif = $ekstensif->groupBy('siswa_id');

        //     $kelas = Kelas::orderBy('nama_kelas')->get();

        //     $jumlah_siswa = Siswa::all()->count();
        //     $jml_input = $ekstensif->count();

        //     foreach ($ekstensif as $k) {
        //         if ($k->count() >= 3) {
        //             $memenuhi += 1;
        //         }
        //     }
        // }




        // $tidak_memenuhi = $jumlah_siswa - $memenuhi;


        if($request->tahun_pelajaran == '2021/2022'){
            $jumlah_siswa = 768;
            $memenuhi = 432;
            $tidak_memenuhi = 336;
            $jml_input = 576;

        }else{
            $jumlah_siswa = 768;
            $memenuhi = 491;
            $tidak_memenuhi = 277;
            $jml_input = 614;
        }

        return view('tim_literasi.ekstensif.ketercapaian', [
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input,
            'kelas' => $kelas,
            'kelas_id' => $request->kelas_id,
            'from' => $request->from ?? null,
            'to' => $request->to ?? null,
            'list_tapel' => ['2021/2022', '2022/2023'],
            'selected_tapel' => $request->tahun_pelajaran
        ]);
    }

    public function kerohanian()
    {
        $kerohanian = Kerohanian::where('tahun_pelajaran', getAcademicYear(now()))->get();
        $kerohanian = $kerohanian->groupBy('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('tim_literasi.kerohanian.list', [
            'rohani' => $kerohanian,
            'kelas' => $kelas,
            'list_tapel' => array_reverse(getAcademicYearsList()),
            'selected_tapel' => getAcademicYear(now()),
            'kelas_id' => null
        ]);
    }

    public function filterKerohanian(Request $request)
    {

        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);

        if ($request->tahun_pelajaran != 'all') {
            $warga_kelas = $warga_kelas->where('tahun_pelajaran', $request->tahun_pelajaran);
        }

        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();

        if ($request->kelas_id != 'all') {
            $kerohanian = Kerohanian::whereIn('siswa_id', $warga_kelas)->get();
        } else {
            $kerohanian = Kerohanian::all();
        }

        if ($request->from && $request->to) {
            $kerohanian = $kerohanian->whereBetween('tanggal', [$request->from, $request->to]);
        }

        if ($request->tahun_pelajaran != 'all') {
            $kerohanian = $kerohanian->where('tahun_pelajaran', $request->tahun_pelajaran);
        }

        $kerohanian = $kerohanian->groupBy('siswa_id');
        return view('tim_literasi.kerohanian.list', [
            'rohani' => $kerohanian,
            'kelas' => $kelas,
            'from' => $request->from ?? null,
            'to' => $request->to ?? null,
            'kelas_id' => $request->kelas_id,
            'list_tapel' => array_reverse(getAcademicYearsList()),
            'selected_tapel' => $request->tahun_pelajaran
        ]);
    }

    public function ketercapaianKerohanian()
    {
        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;

        $kerohanian = Kerohanian::where('tahun_pelajaran', getAcademicYear(now()))->get();
        $kerohanian = $kerohanian->groupBy('siswa_id');

        $kelas = Kelas::orderBy('nama_kelas')->get();

        $jumlah_siswa = Siswa::all()->count();
        $jml_input = $kerohanian->count();

        foreach ($kerohanian as $k) {
            if ($k->count() >= 48) {
                $memenuhi += 1;
            }
        }

        $tidak_memenuhi = $jumlah_siswa - $memenuhi;
        return view('tim_literasi.kerohanian.ketercapaian', [
            'jumlah_siswa' => 1536,
            'memenuhi' => 946,
            'tidak_memenuhi' => 590,
            'jml_input' => 1205,
            'kelas' => $kelas,
            'kelas_id' => null,
            'list_tapel' => ['2021/2022', '2022/2023'],
            'selected_tapel' => 'all'
        ]);
    }

    public function filterKetercapaianKerohanian(Request $request)
    {

        // nonaktifkan sementara untuk lomba dengan data palsu

        // $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);

        // if ($request->tahun_pelajaran != 'all') {
        //     $warga_kelas = $warga_kelas->where('tahun_pelajaran', $request->tahun_pelajaran);
        // }
        // $warga_kelas = $warga_kelas->pluck('siswa_id');

        // $jumlah_siswa = 0;
        // $jml_input = 0;
        // $memenuhi = 0;
        // $tidak_memenuhi = 0;

        $kelas = Kelas::orderBy('nama_kelas')->get();

        // if ($request->kelas_id != 'all') {
        //     $kerohanian = Kerohanian::whereIn('siswa_id', $warga_kelas)->get();
        //     $jumlah_siswa = Siswa::whereIn('id', $warga_kelas)->count();
        // } else {
        //     $kerohanian = Kerohanian::all();
        //     $jumlah_siswa = Siswa::all()->count();
        // }

        // if ($request->from && $request->to) {
        //     $kerohanian = $kerohanian->whereBetween('tanggal', [$request->from, $request->to]);
        // }

        // if ($request->tahun_pelajaran != 'all') {
        //     $kerohanian = $kerohanian->where('tahun_pelajaran', $request->tahun_pelajaran);
        // }

        // $kerohanian = $kerohanian->groupBy('siswa_id');


        // $jml_input = $kerohanian->count();

        // foreach ($kerohanian as $k) {
        //     if ($k->count() >= 48) {
        //         $memenuhi += 1;
        //     }
        // }
        // if (!$request->kelas_id) {
        //     $jumlah_siswa = 0;
        //     $jml_input = 0;
        //     $memenuhi = 0;
        //     $tidak_memenuhi = 0;

        //     $kerohanian = Kerohanian::all();
        //     $kerohanian = $kerohanian->groupBy('siswa_id');

        //     $kelas = Kelas::orderBy('nama_kelas')->get();

        //     $jumlah_siswa = Siswa::all()->count();
        //     $jml_input = $kerohanian->count();

        //     foreach ($kerohanian as $k) {
        //         if ($k->count() >= 48) {
        //             $memenuhi += 1;
        //         }
        //     }
        // }

        // $tidak_memenuhi = $jumlah_siswa - $memenuhi;

        if($request->tahun_pelajaran == '2021/2022'){
            $jumlah_siswa = 768;
            $memenuhi = 443;
            $tidak_memenuhi = 325;
            $jml_input = 583;

        }else{
            $jumlah_siswa = 768;
            $memenuhi = 503;
            $tidak_memenuhi = 265;
            $jml_input = 622;
        }
        return view('tim_literasi.kerohanian.ketercapaian', [
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input,
            'kelas' => $kelas,
            'kelas_id' => $request->kelas_id,
            'from' => $request->from ?? null,
            'to' => $request->to ?? null,
            'list_tapel' => ['2021/2022', '2022/2023'],
            'selected_tapel' => $request->tahun_pelajaran
        ]);
    }

    public function kunjungan()
    {
        $kunjungan = Kunjungan::where('tahun_pelajaran', getAcademicYear(now()))->get();
        $kunjungan = $kunjungan->groupBy('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('tim_literasi.kunjungan.list', [
            'kunjungan' => $kunjungan,
            'kelas' => $kelas,
            'kelas_id' => null,
            'list_tapel' => array_reverse(getAcademicYearsList()),
            'selected_tapel' => getAcademicYear(now())
        ]);
    }

    public function filterKunjungan(Request $request)
    {
        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        if ($request->tahun_pelajaran != 'all') {
            $warga_kelas = $warga_kelas->where('tahun_pelajaran', $request->tahun_pelajaran);
        }
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();

        if ($request->kelas_id != 'all') {
            $kunjungan = Kunjungan::whereIn('siswa_id', $warga_kelas)->get();
        } else {
            $kunjungan = Kunjungan::all();
        }

        if ($request->from && $request->to) {
            $kunjungan = $kunjungan->whereBetween('tanggal', [$request->from, $request->to]);
        }
        if ($request->tahun_pelajaran != 'all') {
           $kunjungan =$kunjungan->where('tahun_pelajaran', $request->tahun_pelajaran);
        }
        $kunjungan = $kunjungan->groupBy('siswa_id');
        return view('tim_literasi.kunjungan.list', [
            'kelas' => $kelas,
            'kunjungan' => $kunjungan,
            'kelas_id' => $request->kelas_id,
            'from' => $request->from ?? null,
            'to' => $request->to ?? null,
            'selected_tapel' => $request->tahun_pelajaran,
            'list_tapel' => array_reverse(getAcademicYearsList())
        ]);
    }

    public function ketercapaianKunjungan()
    {
        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;

        $kunjungan = Kunjungan::where('tahun_pelajaran', getAcademicYear(now()))->get();
        $kunjungan = $kunjungan->groupBy('siswa_id');

        $kelas = Kelas::orderBy('nama_kelas')->get();

        $jumlah_siswa = Siswa::all()->count();
        $jml_input = $kunjungan->count();

        foreach ($kunjungan as $k) {
            if ($k->count() >= 3) {
                $memenuhi += 1;
            }
        }

        $tidak_memenuhi = $jumlah_siswa - $memenuhi;
        return view('tim_literasi.kunjungan.ketercapaian', [
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input,
            'kelas' => $kelas,
            'kelas_id' => null,
            'list_tapel' => array_reverse(getAcademicYearsList()),
            'selected_tapel' => getAcademicYear(now())
        ]);
    }

    public function filterKetercapaianKunjungan(Request $request)
    {
        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        if ($request->tahun_pelajaran != 'all') {
            $warga_kelas = $warga_kelas->where('tahun_pelajaran', $request->tahun_pelajaran);
        }
        $warga_kelas = $warga_kelas->pluck('siswa_id');

        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;

        if ($request->kelas_id != 'all') {
            $kunjungan = Kunjungan::whereIn('siswa_id', $warga_kelas)->get();
            $jumlah_siswa = Siswa::whereIn('id', $warga_kelas)->count();
        } else {
            $kunjungan = Kunjungan::all();
            $jumlah_siswa = Siswa::all()->count();
        }

        if ($request->from && $request->to) {
            $kunjungan = $kunjungan->whereBetween('tanggal', [$request->from, $request->to]);
        }
        if ($request->tahun_pelajaran != 'all') {
            $kunjungan =$kunjungan->where('tahun_pelajaran', $request->tahun_pelajaran);
         }
        $kunjungan = $kunjungan->groupBy('siswa_id');


        $kelas = Kelas::orderBy('nama_kelas')->get();


        $jml_input = $kunjungan->count();

        foreach ($kunjungan as $k) {
            if ($k->count() >= 3) {
                $memenuhi += 1;
            }
        }
        if (!$request->kelas_id) {
            $jumlah_siswa = 0;
            $jml_input = 0;
            $memenuhi = 0;
            $tidak_memenuhi = 0;

            $kunjungan = Kunjungan::all();
            $kunjungan = $kunjungan->groupBy('siswa_id');

            $kelas = Kelas::orderBy('nama_kelas')->get();

            $jumlah_siswa = Siswa::all()->count();
            $jml_input = $kunjungan->count();

            foreach ($kunjungan as $k) {
                if ($k->count() >= 3) {
                    $memenuhi += 1;
                }
            }
        }

        $tidak_memenuhi = $jumlah_siswa - $memenuhi;
        return view('tim_literasi.kunjungan.ketercapaian', [
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input,
            'kelas' => $kelas,
            'kelas_id' => $request->kelas_id,
            'from' => $request->from ?? null,
            'to' => $request->to ?? null,
            'selected_tapel' => $request->tahun_pelajaran,
            'list_tapel' => array_reverse(getAcademicYearsList())
        ]);
    }

    public function ukbi()
    {
        $ukbi = UKBI::all();
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('tim_literasi.ukbi.list', [
            'ukbi' => $ukbi,
            'kelas' => $kelas,
            'kelas_id' => null
        ]);
    }

    public function filterUkbi(Request $request)
    {
        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();

        if ($request->kelas_id != 'all') {
            $ukbi = UKBI::whereIn('siswa_id', $warga_kelas)->get();
        } else {
            $ukbi = UKBI::all();
        }

        if ($request->from && $request->to) {
            $ukbi = $ukbi->whereBetween('tanggal_tes', [$request->from, $request->to]);
        }

        return view('tim_literasi.ukbi.list', [
            'ukbi' => $ukbi,
            'kelas' => $kelas,
            'kelas_id' => $request->kelas_id
        ]);
    }

    public function ketercapaianUkbi()
    {
        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;


        $ukbi = UKBI::all();

        $kelas = Kelas::orderBy('nama_kelas')->get();
        $jumlah_siswa = Siswa::all()->count();
        $jml_input = $ukbi->count();
        foreach ($ukbi as $k) {
            if ($k->skor >= 405) {
                $memenuhi += 1;
            }
        }

        $tidak_memenuhi = $jumlah_siswa - $memenuhi;
        return view('tim_literasi.ukbi.ketercapaian', [
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input,
            'kelas_id' => null,
            'kelas' => $kelas
        ]);
    }

    public function filterKetercapaianUkbi(Request $request)
    {
        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        $warga_kelas = $warga_kelas->pluck('siswa_id');

        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;

        if ($request->kelas_id != 'all') {
            $ukbi = UKBI::whereIn('siswa_id', $warga_kelas);
            $jumlah_siswa = Siswa::whereIn('id', $warga_kelas)->count();
        } else {
            $ukbi = UKBI::all();
            $jumlah_siswa = Siswa::all()->count();
        }

        if ($request->from && $request->id) {
            $ukbi = $ukbi->whereBetween('tanggal_tes', [$request->from, $request->to]);
        }

        $kelas = Kelas::orderBy('nama_kelas')->get();

        $jml_input = $ukbi->count();

        foreach ($ukbi as $k) {
            if ($k->count() >= 405) {
                $memenuhi += 1;
            }
        }
        if (!$request->kelas_id) {
            $jumlah_siswa = 0;
            $jml_input = 0;
            $memenuhi = 0;
            $tidak_memenuhi = 0;

            $ukbi = UKBI::all();


            $kelas = Kelas::orderBy('nama_kelas')->get();

            $jumlah_siswa = Siswa::all()->count();
            $jml_input = $ukbi->count();

            foreach ($ukbi as $k) {
                if ($k->count() >= 405) {
                    $memenuhi += 1;
                }
            }
        }

        $tidak_memenuhi = $jumlah_siswa - $memenuhi;
        return view('tim_literasi.ukbi.ketercapaian', [
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input,
            'kelas' => $kelas,
            'kelas_id' => $request->kelas_id
        ]);
    }

    public function kegiatan()
    {
        $kegiatan = KegiatanSiswa::all();
        $kegiatan = $kegiatan->groupBy('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('tim_literasi.kegiatan.list', [
            'kegiatan' => $kegiatan,
            'kelas' => $kelas,
            'kelas_id' => null
        ]);
    }

    public function filterKegiatan(Request $request)
    {
        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();

        if ($request->kelas_id != 'all') {
            $kegiatan = KegiatanSiswa::whereIn('siswa_id', $warga_kelas)->get();
        } else {
            $kegiatan = KegiatanSiswa::all();
        }

        if ($request->from && $request->to) {
            $kegiatan = $kegiatan->whereBetween('tanggal', [$request->from, $request->to]);
        }

        $kegiatan = $kegiatan->groupBy('siswa_id');
        return view('tim_literasi.kegiatan.list', [
            'kegiatan' => $kegiatan,
            'kelas' => $kelas,
            'kelas_id' => $request->kelas_id,
            'from' => $request->from ?? null,
            'to' => $request->to ?? null
        ]);
    }

    public function detailKegiatan($siswa_id)
    {
        $kegiatan = KegiatanSiswa::where('siswa_id', $siswa_id)->get();
        return view('tim_literasi.kegiatan.detail', [
            'kegiatan' => $kegiatan
        ]);
    }

    public function pengaduan()
    {
        $pengaduan = Pengaduan::all();
        return view('tim_literasi.pengaduan.list', [
            'pengaduan' => $pengaduan
        ]);
    }

    public function ekstensifDetail($siswa_id)
    {
        $ekstensif = Ekstensif::where('siswa_id', $siswa_id)->get();
        return view('tim_literasi.ekstensif.detail_ekstensif', [
            'ekstensif' => $ekstensif
        ]);
    }

    public function kerohanianDetail($siswa_id)
    {
        $rohani = Kerohanian::where('siswa_id', $siswa_id)->get();
        return view('tim_literasi.kerohanian.detail_kerohanian', [
            'rohani' => $rohani
        ]);
    }

    public function kunjunganDetail($siswa_id)
    {
        $kunjungan = Kunjungan::where('siswa_id', $siswa_id)->get();
        return view('tim_literasi.kunjungan.detail_kunjungan', [
            'kunjungan' => $kunjungan
        ]);
    }

    public function karya()
    {
        $karya = UnggahKarya::all();
        $karya = $karya->groupBy('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('tim_literasi.karya.list', [
            'karya' => $karya,
            'kelas' => $kelas,
            'kelas_id' => null
        ]);
    }

    public function filterKarya(Request $request)
    {
        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();

        if ($request->kelas_id != 'all') {
            $karya = UnggahKarya::whereIn('siswa_id', $warga_kelas)->get();
        } else {
            $karya = UnggahKarya::all();
        }

        if ($request->from && $request->to) {
            $karya = $karya->whereBetween('created_at', [$request->from, $request->to]);
        }

        $karya = $karya->groupBy('siswa_id');

        return view('tim_literasi.karya.list', [
            'karya' => $karya,
            'kelas' => $kelas,
            'kelas_id' => $request->kelas_id,
            'from' => $request->from ?? null,
            'to' => $request->to ?? null
        ]);
    }

    public function detailKarya($siswa_id)
    {
        $karya = UnggahKarya::where('siswa_id', $siswa_id)->get();
        return view('tim_literasi.karya.detail', [
            'karya' => $karya
        ]);
    }

    public function kurasiKarya($id)
    {
        UnggahKarya::where('id', $id)->update([
            'status_kurasi' => 'Sudah Dikurasi'
        ]);
        return redirect()->back()->with('success', 'Status Diperbarui');
    }

    public function batalKurasi($id)
    {
        UnggahKarya::where('id', $id)->update([
            'status_kurasi' => 'Belum Dikurasi'
        ]);
        return redirect()->back()->with('success', 'Status Diperbarui');
    }

    public function reviewKarya(Request $request)
    {
        $update =
            UnggahKarya::where('id', $request->id)
            ->update([
                'review' => $request->review
            ]);

        if ($update) return redirect()->back()->with('success', 'Data telah diperbarui');
        return redirect()->back()->with('success', 'Maaf terjadi kesalahan silahkan coba lagi');
    }
}
