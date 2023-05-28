<?php

namespace App\Http\Controllers\Walas;


use App\Models\Ekstensif;
use App\Models\WaliKelas;
use App\Models\Kerohanian;
use App\Models\WargaKelas;
use Illuminate\Http\Request;
use App\Models\ReviewLiterasi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Karya;
use App\Models\KegiatanSiswa;
use App\Models\Kunjungan;
use App\Models\UKBI;
use App\Models\UnggahKarya;

class EkstensifWalasController extends Controller
{
    public function ekstensif()
    {
        $warga_kelas = WargaKelas::where('wali_kelas_id', auth()->guard('guru')->user()->id)->get();
        $warga_kelas = $warga_kelas->pluck('siswa_id');

        $ekstensif = Ekstensif::whereIn('siswa_id', $warga_kelas)->orderBy('siswa_id', 'ASC')
            ->get();

        $ekstensif = $ekstensif->groupBy('siswa_id');
        $ekstensif = $ekstensif->map(function ($query) {
            return $query->groupBy('isbn');
        });

        return view('walas.ekstensif.list', [
            'ekstensif' => $ekstensif
        ]);
    }

    public function detailEkstensif($siswa_id)
    {
        $ekstensif = Ekstensif::where('siswa_id', $siswa_id)->get();
        return view('walas.ekstensif.detail_ekstensif', [
            'ekstensif' => $ekstensif
        ]);
    }

    public function ketercapaianEkstensif()
    {
        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;

        $warga_kelas = WargaKelas::where('wali_kelas_id', auth()->guard('guru')->user()->id)->get();
        $warga_kelas = $warga_kelas->pluck('siswa_id');

        $ekstensif = Ekstensif::whereIn('siswa_id', $warga_kelas)
            ->get();

        $ekstensif = $ekstensif->groupBy('siswa_id');
        $ekstensif = $ekstensif->map(function ($query) {
            return $query->groupBy('isbn');
        });
        $jml_input = $ekstensif->count();

        $jumlah_siswa = $warga_kelas->count();
        foreach ($ekstensif as $e) {
            foreach ($e as $a) {
                if ($e->count() >= 3) {
                    $memenuhi += 1;
                    break;
                }
            }
        }
        $tidak_memenuhi = $jumlah_siswa - $memenuhi;

        return view('walas.ekstensif.ketercapaian', [
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input
        ]);
    }

    public function kerohanian()
    {
        $warga_kelas = WargaKelas::where('wali_kelas_id', auth()->guard('guru')->user()->id)->get();
        $warga_kelas = $warga_kelas->pluck('siswa_id');

        $kerohanian = Kerohanian::whereIn('siswa_id', $warga_kelas)->orderBy('siswa_id', 'ASC')->get();
        $kerohanian = $kerohanian->groupBy('siswa_id');
        // return $kerohanian;

        return view('walas.kerohanian.list', [
            'rohani' => $kerohanian
        ]);
    }

    public function ketercapaianKerohanian()
    {
        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;

        $warga_kelas = WargaKelas::where('wali_kelas_id', auth()->guard('guru')->user()->id)->get();
        $warga_kelas = $warga_kelas->pluck('siswa_id');

        $kerohanian = Kerohanian::whereIn('siswa_id', $warga_kelas)->get();
        $kerohanian = $kerohanian->groupBy('siswa_id');
        $jumlah_siswa = $warga_kelas->count();
        $jml_input = $kerohanian->count();

        foreach ($kerohanian as $k) {
            if ($k->count() >= 48) {
                $memenuhi += 1;
            }
        }

        $tidak_memenuhi = $jumlah_siswa - $memenuhi;
        return view('walas.kerohanian.ketercapaian', [
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input
        ]);
    }

    public function kunjungan()
    {
        $warga_kelas = WargaKelas::where('wali_kelas_id', auth()->guard('guru')->user()->id)->get();
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $kunjungan = Kunjungan::whereIn('siswa_id', $warga_kelas)->orderBy('siswa_id', 'ASC')->get();
        $kunjungan = $kunjungan->groupBy('siswa_id');

        return view('walas.kunjungan.list', [
            'kunjungan' => $kunjungan
        ]);
    }

    public function ketercapaianKunjungan()
    {


        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;

        $warga_kelas = WargaKelas::where('wali_kelas_id', auth()->guard('guru')->user()->id)->get();
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $kunjungan = Kunjungan::whereIn('siswa_id', $warga_kelas)->get();
        $kunjungan = $kunjungan->groupBy('siswa_id');

        $jumlah_siswa = $warga_kelas->count();
        $jml_input = $kunjungan->count();

        foreach ($kunjungan as $k) {
            if ($k->count() >= 3) {
                $memenuhi += 1;
            }
        }

        $tidak_memenuhi = $jumlah_siswa - $memenuhi;
        return view('walas.kunjungan.ketercapaian', [
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input
        ]);
    }

    public function detailKunjungan($siswa_id)
    {
        $kunjungan = Kunjungan::where('siswa_id', $siswa_id)->get();
        return view('walas.kunjungan.detail_kunjungan', [
            'kunjungan' => $kunjungan
        ]);
    }

    public function ukbi()
    {
        $warga_kelas = WargaKelas::where('wali_kelas_id', auth()->guard('guru')->user()->id)->get();
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $ukbi = UKBI::whereIn('siswa_id', $warga_kelas)->orderBy('siswa_id', 'ASC')->get();

        return view('walas.ukbi.list', [
            'ukbi' => $ukbi
        ]);
    }

    public function ketercapaianUkbi(){
        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;

        $warga_kelas = WargaKelas::where('wali_kelas_id', auth()->guard('guru')->user()->id)->get();
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $ukbi = UKBI::whereIn('siswa_id', $warga_kelas)->get();


        $jumlah_siswa = $warga_kelas->count();
        $jml_input = $ukbi->count();
        foreach ($ukbi as $k) {
            if ($k->skor >= 405) {
                $memenuhi += 1;
            }
        }

        $tidak_memenuhi = $jumlah_siswa - $memenuhi;
        return view('walas.ukbi.ketercapaian', [
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input
        ]);
    }

    public function karya()
    {
        $warga_kelas = WargaKelas::where('wali_kelas_id', auth()->guard('guru')->user()->id)->get();
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $karya = UnggahKarya::whereIn('siswa_id', $warga_kelas)->orderBy('siswa_id', 'ASC')->get();
        $karya = $karya->groupBy('siswa_id');

        return view('walas.karya.list', [
            'karya' => $karya
        ]);
    }

    public function detailKarya($siswa_id)
    {
        $karya = UnggahKarya::where('siswa_id', $siswa_id)->get();
        return view('walas.karya.detail', [
            'karya' => $karya
        ]);
    }


    public function kegiatan()
    {
        $warga_kelas = WargaKelas::where('wali_kelas_id', auth()->guard('guru')->user()->id)->get();
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $kegiatan = KegiatanSiswa::whereIn('siswa_id', $warga_kelas)->orderBy('siswa_id', 'ASC')->get();
        $kegiatan = $kegiatan->groupBy('siswa_id');

        return view('walas.kegiatan.list', [
            'kegiatan' => $kegiatan
        ]);
    }

    public function detailKegiatan($siswa_id)
    {
        $kegiatan = KegiatanSiswa::where('siswa_id', $siswa_id)->get();
        return view('walas.kegiatan.detail', [
            'kegiatan' => $kegiatan
        ]);
    }

    public function detailKerohanian($siswa_id)
    {
        $rohani = Kerohanian::where('siswa_id', $siswa_id)->get();
        return view('walas.kerohanian.detail_kerohanian', [
            'rohani' => $rohani
        ]);
    }

    public function review()
    {
        $review = ReviewLiterasi::whereNull('wali_kelas_id')
            ->orWhere('wali_kelas_id', auth()->guard('guru')->user()->id)->get();
        return view('walas.review.list', [
            'review' => $review
        ]);
    }

    public function grafikEkstensif()
    {

        // Ambil Siswa ID
        $warga_kelas = WargaKelas::where('wali_kelas_id', auth()->guard('guru')->user()->id)->get();
        $warga_kelas = $warga_kelas->pluck('siswa_id');

        $ekstensif = DB::table('ekstensif')
            ->select('siswa_id', DB::raw('count(*) as total'))
            ->whereIn('siswa_id', $warga_kelas)
            ->groupBy('siswa_id')
            ->groupBy('isbn')
            ->get();

        $count_memenuhi = $ekstensif->where('total', '>=', 6);
        $id_count = $count_memenuhi->pluck('siswa_id');
        $count_tidak = $ekstensif->where('total', '<', 6)
            ->whereNotIn('siswa_id', $id_count);


        return view('walas.ekstensif.grafik', [
            'memenuhi' => $count_memenuhi->count(),
            'tidak_memenuhi' => $count_tidak->count()
        ]);
    }

    public function grafikKerohanian()
    {

        // Ambil Siswa ID
        $warga_kelas = WargaKelas::where('wali_kelas_id', auth()->guard('guru')->user()->id)->get();
        $warga_kelas = $warga_kelas->pluck('siswa_id');

        $ekstensif = DB::table('kerohanians')
            ->select('siswa_id', DB::raw('count(*) as total'))
            ->whereIn('siswa_id', $warga_kelas)
            ->groupBy('siswa_id')
            ->groupBy('data_kerohanian_id')
            ->get();

        $count_memenuhi = $ekstensif->where('total', '>=', 6);
        $id_count = $count_memenuhi->pluck('siswa_id');
        $count_tidak = $ekstensif->where('total', '<', 6)
            ->whereNotIn('siswa_id', $id_count);


        return view('walas.kerohanian.grafik', [
            'memenuhi' => $count_memenuhi->count(),
            'tidak_memenuhi' => $count_tidak->count()
        ]);
    }
}
