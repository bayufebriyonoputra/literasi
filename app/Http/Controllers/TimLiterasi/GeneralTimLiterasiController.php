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
        $ekstensif = Ekstensif::all();
        $ekstensif = $ekstensif->groupBy('siswa_id');
        $ekstensif = $ekstensif->map(function ($query) {
            return $query->groupBy('isbn');
        });
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('tim_literasi.ekstensif.list', [
            'ekstensif' => $ekstensif,
            'kelas' => $kelas
        ]);
    }

    public function filterEkstensif(Request $request)
    {
        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();

        $ekstensif = Ekstensif::whereIn('siswa_id', $warga_kelas)->get();
        $ekstensif = $ekstensif->groupBy('siswa_id');
        $ekstensif = $ekstensif->map(function ($query) {
            return $query->groupBy('isbn');
        });
        return view('tim_literasi.ekstensif.list', [
            'ekstensif' => $ekstensif,
            'kelas' => $kelas
        ]);
    }

    public function ketercapaianEkstensif()
    {
        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;

        $ekstensif = Ekstensif::all();
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
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input,
            'kelas' => $kelas,
            'kelas_id' => null
        ]);
    }

    public function filterKetercapaianEkstensif(Request $request)
    {
        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        $warga_kelas = $warga_kelas->pluck('siswa_id');

        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;

        $ekstensif = Ekstensif::whereIn('siswa_id', $warga_kelas)->get();
        $ekstensif = $ekstensif->groupBy('siswa_id');

        $kelas = Kelas::orderBy('nama_kelas')->get();

        $jumlah_siswa = Siswa::whereIn('id', $warga_kelas)->count();
        $jml_input = $ekstensif->count();

        foreach ($ekstensif as $k) {
            if ($k->count() >= 3) {
                $memenuhi += 1;
            }
        }
        if (!$request->kelas_id) {
            $jumlah_siswa = 0;
            $jml_input = 0;
            $memenuhi = 0;
            $tidak_memenuhi = 0;

            $ekstensif = Ekstensif::all();
            $ekstensif = $ekstensif->groupBy('siswa_id');

            $kelas = Kelas::orderBy('nama_kelas')->get();

            $jumlah_siswa = Siswa::all()->count();
            $jml_input = $ekstensif->count();

            foreach ($ekstensif as $k) {
                if ($k->count() >= 3) {
                    $memenuhi += 1;
                }
            }
        }



        $tidak_memenuhi = $jumlah_siswa - $memenuhi;
        return view('tim_literasi.ekstensif.ketercapaian', [
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input,
            'kelas' => $kelas,
            'kelas_id' => $request->kelas_id
        ]);
    }

    public function kerohanian()
    {
        $kerohanian = Kerohanian::all();
        $kerohanian = $kerohanian->groupBy('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('tim_literasi.kerohanian.list', [
            'rohani' => $kerohanian,
            'kelas' => $kelas
        ]);
    }

    public function filterKerohanian(Request $request)
    {
        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();

        $kerohanian = Kerohanian::whereIn('siswa_id', $warga_kelas)->get();
        $kerohanian = $kerohanian->groupBy('siswa_id');
        return view('tim_literasi.kerohanian.list', [
            'rohani' => $kerohanian,
            'kelas' => $kelas
        ]);
    }

    public function ketercapaianKerohanian()
    {
        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;

        $kerohanian = Kerohanian::all();
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
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input,
            'kelas' => $kelas,
            'kelas_id' => null
        ]);
    }

    public function filterKetercapaianKerohanian(Request $request)
    {
        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        $warga_kelas = $warga_kelas->pluck('siswa_id');

        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;

        $kelas = Kelas::orderBy('nama_kelas')->get();

        $kerohanian = Kerohanian::whereIn('siswa_id', $warga_kelas)->get();
        $kerohanian = $kerohanian->groupBy('siswa_id');

        $jumlah_siswa = Siswa::whereIn('id', $warga_kelas)->count();
        $jml_input = $kerohanian->count();

        foreach ($kerohanian as $k) {
            if ($k->count() >= 48) {
                $memenuhi += 1;
            }
        }
        if (!$request->kelas_id) {
            $jumlah_siswa = 0;
            $jml_input = 0;
            $memenuhi = 0;
            $tidak_memenuhi = 0;

            $kerohanian = Kerohanian::all();
            $kerohanian = $kerohanian->groupBy('siswa_id');

            $kelas = Kelas::orderBy('nama_kelas')->get();

            $jumlah_siswa = Siswa::all()->count();
            $jml_input = $kerohanian->count();

            foreach ($kerohanian as $k) {
                if ($k->count() >= 48) {
                    $memenuhi += 1;
                }
            }
        }

        $tidak_memenuhi = $jumlah_siswa - $memenuhi;
        return view('tim_literasi.kerohanian.ketercapaian', [
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input,
            'kelas' => $kelas,
            'kelas_id' => $request->kelas_id
        ]);
    }

    public function kunjungan()
    {
        $kunjungan = Kunjungan::all();
        $kunjungan = $kunjungan->groupBy('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('tim_literasi.kunjungan.list', [
            'kunjungan' => $kunjungan,
            'kelas' => $kelas
        ]);
    }

    public function filterKunjungan(Request $request)
    {
        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();

        $kunjungan = Kunjungan::whereIn('siswa_id', $warga_kelas)->get();
        $kunjungan = $kunjungan->groupBy('siswa_id');
        return view('tim_literasi.kunjungan.list', [
            'kelas' => $kelas,
            'kunjungan' => $kunjungan
        ]);
    }

    public function ketercapaianKunjungan()
    {
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

        $tidak_memenuhi = $jumlah_siswa - $memenuhi;
        return view('tim_literasi.kunjungan.ketercapaian', [
            'jumlah_siswa' => $jumlah_siswa,
            'memenuhi' => $memenuhi,
            'tidak_memenuhi' => $tidak_memenuhi,
            'jml_input' => $jml_input,
            'kelas' => $kelas,
            'kelas_id' => null
        ]);
    }

    public function filterKetercapaianKunjungan(Request $request)
    {
        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        $warga_kelas = $warga_kelas->pluck('siswa_id');

        $jumlah_siswa = 0;
        $jml_input = 0;
        $memenuhi = 0;
        $tidak_memenuhi = 0;

        $kunjungan = Kunjungan::whereIn('siswa_id', $warga_kelas)->get();
        $kunjungan = $kunjungan->groupBy('siswa_id');


        $kelas = Kelas::orderBy('nama_kelas')->get();

        $jumlah_siswa = Siswa::whereIn('id', $warga_kelas)->count();
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
            'kelas_id' => $request->kelas_id
        ]);
    }

    public function ukbi()
    {
        $ukbi = UKBI::all();
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('tim_literasi.ukbi.list', [
            'ukbi' => $ukbi,
            'kelas' => $kelas
        ]);
    }

    public function filterUkbi(Request $request)
    {
        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();

        $ukbi = UKBI::whereIn('siswa_id', $warga_kelas)->get();
        return view('tim_literasi.ukbi.list', [
            'ukbi' => $ukbi,
            'kelas' => $kelas
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

        $ukbi = UKBI::whereIn('siswa_id', $warga_kelas);

        $kelas = Kelas::orderBy('nama_kelas')->get();

        $jumlah_siswa = Siswa::whereIn('id', $warga_kelas)->count();
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
            'kelas' => $kelas
        ]);
    }

    public function filterKegiatan(Request $request)
    {
        $warga_kelas = WargaKelas::where('kelas_id', $request->kelas_id);
        $warga_kelas = $warga_kelas->pluck('siswa_id');
        $kelas = Kelas::orderBy('nama_kelas')->get();

        $kegiatan = KegiatanSiswa::whereIn('siswa_id', $warga_kelas)->get();
        $kegiatan = $kegiatan->groupBy('siswa_id');
        return view('tim_literasi.kegiatan.list', [
            'kegiatan' => $kegiatan,
            'kelas' => $kelas
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

        $karya = UnggahKarya::whereIn('siswa_id', $warga_kelas)->get();
        $karya = $karya->groupBy('siswa_id');

        return view('tim_literasi.karya.list', [
            'karya' => $karya,
            'kelas' => $kelas,
            'kelas_id' => $request->kelas_id
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
