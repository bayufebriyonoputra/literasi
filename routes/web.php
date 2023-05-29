<?php

use App\Models\DataKerohanian;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Siswa\UkbiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KaryaController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Siswa\TugasController;
use App\Http\Controllers\Admin\TempatController;
use App\Http\Controllers\Admin\WaliKelasController;
use App\Http\Controllers\Siswa\EkstensifController;
use App\Http\Controllers\Siswa\KunjunganController;
use App\Http\Controllers\Admin\WargaKelasController;
use App\Http\Controllers\Siswa\KerohanianController;
use App\Http\Controllers\Admin\TimLiterasiController;
use App\Http\Controllers\Siswa\UnggahKaryaController;
use App\Http\Controllers\Siswa\ApiKerohanianController;
use App\Http\Controllers\Admin\DataKerohanianController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Perpustakaan\GeneralPerpustakaanController;
use App\Http\Controllers\Walas\EkstensifWalasController;
use App\Http\Controllers\TimLiterasi\ReviewLiterasiController;
use App\Http\Controllers\TimLiterasi\TugasTimLiterasiController;
use App\Http\Controllers\TimLiterasi\GeneralTimLiterasiController;
use App\Http\Controllers\TimLiterasi\PerpustakaanController;
use App\Models\Perpustakaan;
use App\Http\Controllers\Admin\PerpustakaanController as AdminPerpus;
use App\Http\Controllers\Siswa\KegiatanSiswaController;
use App\Models\KegiatanPerpustakaan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $buku = Perpustakaan::orderBy('created_at', 'DESC')->paginate(4, ['*'], 'buku');
    $kegiatan = KegiatanPerpustakaan::orderBy('created_at', 'DESC')->paginate(4, ['*'], 'kegiatan');
    return view('landing_page', [
        'buku' => $buku,
        'kegiatan' => $kegiatan
    ]);
});

// Route Pengaduan
Route::get('/pengaduan', [PengaduanController::class, 'index']);
Route::post('/pengaduan', [PengaduanController::class, 'store']);

// AUTH
Route::get('/login-siswa', [LoginController::class, 'viewSiswa']);
Route::post('/login-siswa', [LoginController::class, 'loginSiswa']);
Route::get('/login-guru', [LoginController::class, 'viewGuru']);
Route::post('/login-guru', [LoginController::class, 'loginGuru']);
Route::get('/logout', [LoginController::class, 'logout']);

// Ganti Pass
Route::post('/ganti-pass', [LoginController::class, 'changePassword']);
Route::get('/siswa-gantipass', [LoginController::class, 'changePassSiswa'])->middleware('siswa');
Route::get('/admin-gantipass', [LoginController::class, 'changePassAdmin'])->middleware('admin');
Route::get('/perpus-gantipass', [LoginController::class, 'changePassPerpus'])->middleware('perpus');
Route::get('/literasi-gantipass', [LoginController::class, 'changePassLiterasi'])->middleware('inovasi');
Route::get('/walas-gantipass', [LoginController::class, 'changePassWalas'])->middleware('walas');

Route::get('/test', function () {
    $rohani = DataKerohanian::where('agama', 'Islam')->get();
    $rohani = $rohani->pluck('kegiatan', 'id');

    return $rohani;
});


// Route Siswa
// Route untuk ajax siswa
Route::get('/kegiatan', [ApiKerohanianController::class, 'kegiatan'])->name('kegiatan');

// CRUD Ekstensif
Route::resource('/ekstensif', EkstensifController::class)->middleware('siswa');
// CRUD Kerohanian
Route::resource('/kerohanian', KerohanianController::class)->middleware('siswa');
// CRUD Kunjungan
Route::resource('/kunjungan', KunjunganController::class)->middleware('siswa');

// CRUD KEGIATAN
Route::get('/siswa-kegiatan/add', [KegiatanSiswaController::class, 'create'])->middleware('siswa');
Route::post('/siswa-kegiatan/add', [KegiatanSiswaController::class, 'store'])->middleware('siswa');
Route::get('/siswa-kegiatan/list', [KegiatanSiswaController::class, 'list'])->middleware('siswa');
Route::delete('/siswa-kegiatan/{kegiatan}', [KegiatanSiswaController::class, 'destroy'])->middleware('siswa');
Route::get('/siswa-kegiatan/{kegiatan}/edit', [KegiatanSiswaController::class, 'edit'])->middleware('siswa');
Route::put('/siswa-kegiatan/{kegiatan}', [KegiatanSiswaController::class, 'update'])->middleware('siswa');

Route::resource('/unggah_karya', UnggahKaryaController::class)->middleware('siswa');
Route::resource('/ukbi', UkbiController::class)->middleware('siswa');

Route::get('/tugas-ekstensif', [TugasController::class, 'ekstensif'])->middleware('siswa');
Route::get('/tugas-kerohanian', [TugasController::class, 'kerohanian'])->middleware('siswa');
Route::get('/tugas-kunjungan', [TugasController::class, 'kunjungan'])->middleware('siswa');
Route::get('/tugas-ukbi', [TugasController::class, 'ukbi'])->middleware('siswa');
Route::get('/tugas-karya', [TugasController::class, 'karya'])->middleware('siswa');






// Admin Route
Route::get('/admin-dashboard', [AdminController::class, 'index'])->middleware('admin');
// CRUD DATA KEROHANIAN
Route::resource('/data_kerohanian', DataKerohanianController::class);
// CRUD tempat
Route::resource('/tempat', TempatController::class)->middleware('admin');
// CRUD Karya
Route::resource('/karya', KaryaController::class)->middleware('admin');
// crud siswa
Route::resource('/admin-siswa', SiswaController::class)->middleware('admin');
// CRUD WALAS
Route::resource('/admin-walas', WaliKelasController::class)->middleware('admin');
// CRUD WARGA KELAS
Route::resource('/admin-warga', WargaKelasController::class)->middleware('admin');
// CRUD KELAS
Route::resource('/admin-kelas', KelasController::class)->middleware('admin');
// CRUD GURU
Route::resource('/admin-guru', GuruController::class)->middleware('admin');

// Route CRUD Tim Literasi
Route::get('/tim-literasi', [TimLiterasiController::class, 'index'])->middleware('admin');
Route::post('/tim-literasi', [TimLiterasiController::class, 'add'])->middleware('admin');
Route::delete('/tim-literasi/{tim_literasi}', [TimLiterasiController::class, 'remove'])->middleware('admin');

// Route CRUD Perpustakaan
Route::get('/admin-perpustakaan', [AdminPerpus::class, 'index'])->middleware('admin');
Route::post('/admin-perpustakaan', [AdminPerpus::class, 'add'])->middleware('admin');
Route::delete('/admin-perpustakaan/{perpustakaan}', [AdminPerpus::class, 'remove'])->middleware('admin');


// Route Wali Kelas


Route::get('/walas-review', [EkstensifWalasController::class, 'review'])->middleware('walas');

// Laporan Ekstensif Walas
Route::get('/walas-ekstensif', [EkstensifWalasController::class, 'ekstensif'])->middleware('walas');
Route::post('/walas-filter-ekstensif', [EkstensifWalasController::class, 'filterEkstensif'])->middleware('walas');
Route::get('/walas-kerohanian', [EkstensifWalasController::class, 'kerohanian'])->middleware('walas');
Route::post('/walas-kerohanian-filter', [EkstensifWalasController::class, 'filterKerohanian'])->middleware('walas');
Route::get('/walas-kunjungan', [EkstensifWalasController::class, 'kunjungan'])->middleware('walas');
Route::post('/walas-kunjungan-filter', [EkstensifWalasController::class, 'filterKunjungan'])->middleware('walas');
Route::get('/walas-ukbi', [EkstensifWalasController::class, 'ukbi'])->middleware('walas');
Route::get('/walas-karya', [EkstensifWalasController::class, 'karya'])->middleware('walas');
Route::get('/walas-kegiatan', [EkstensifWalasController::class, 'kegiatan'])->middleware('walas');

Route::get('/ketercapaian-ekstensif', [EkstensifWalasController::class, 'ketercapaianEkstensif'])->middleware('walas');
Route::post('/ketercapaian-ekstensif-filter', [EkstensifWalasController::class, 'filterKetercapaianEkstensif'])->middleware('walas');
Route::get('/ketercapaian-kerohanian', [EkstensifWalasController::class, 'ketercapaianKerohanian'])->middleware('walas');
Route::post('/ketercapaian-kerohanian-filter', [EkstensifWalasController::class, 'filterKetercapaianKerohanian'])->middleware('walas');
Route::get('/ketercapaian-kunjungan', [EkstensifWalasController::class, 'ketercapaianKunjungan'])->middleware('walas');
Route::post('/ketercapaian-kunjungan-filter', [EkstensifWalasController::class, 'filterKetercapaianKunjungan'])->middleware('walas');
Route::get('/ketercapaian-ukbi', [EkstensifWalasController::class, 'ketercapaianUkbi'])->middleware('walas');
Route::get('/detail-ekstensif/{siswa_id}', [EkstensifWalasController::class, 'detailEkstensif'])->middleware('walas_inovasi');
Route::get('/detail-rohani/{siswa_id}', [EkstensifWalasController::class, 'detailKerohanian'])->middleware('walas_inovasi');
Route::get('/detail-kunjungan/{siswa_id}', [EkstensifWalasController::class, 'detailKunjungan'])->middleware('walas_inovasi');
Route::get('/detail-karya/{siswa_id}', [EkstensifWalasController::class, 'detailKarya'])->middleware('walas_inovasi');
Route::get('/detail-kegiatan/{siswa_id}', [EkstensifWalasController::class, 'detailKegiatan'])->middleware('walas_inovasi');



// Route TIM Literasi

// CRUD TUGAS
Route::resource('/tugas-literasi', TugasTimLiterasiController::class)->middleware('inovasi');
// CRUD REVIEW
Route::resource('/review-literasi', ReviewLiterasiController::class)->middleware('inovasi');



Route::get('/inovasi-ekstensif', [GeneralTimLiterasiController::class, 'ekstensif'])->middleware('inovasi');
Route::get('/inovasi-kerohanian', [GeneralTimLiterasiController::class, 'kerohanian'])->middleware('inovasi');
Route::get('/inovasi-kunjungan', [GeneralTimLiterasiController::class, 'kunjungan'])->middleware('inovasi');
Route::get('/inovasi-ukbi', [GeneralTimLiterasiController::class, 'ukbi'])->middleware('inovasi');
Route::get('/inovasi-kegiatan', [GeneralTimLiterasiController::class, 'kegiatan'])->middleware('inovasi');
Route::get('/inovasi-pengaduan', [GeneralTimLiterasiController::class, 'pengaduan'])->middleware('inovasi');
Route::get('/inovasi-karya', [GeneralTimLiterasiController::class, 'karya'])->middleware('inovasi');
Route::get('/inovasi-detail-ekstensif/{siswa_id}', [GeneralTimLiterasiController::class, 'ekstensifDetail'])->middleware('inovasi');
Route::get('/inovasi-detail-karya/{siswa_id}', [GeneralTimLiterasiController::class, 'detailKarya'])->middleware('inovasi');
Route::post('/inovasi-karya', [GeneralTimLiterasiController::class, 'reviewKarya'])->middleware('inovasi');
Route::get('/inovasi-karya-kurasi/{id}', [GeneralTimLiterasiController::class, 'kurasiKarya'])->middleware('inovasi');
Route::get('/inovasi-karya-unkurasi/{id}', [GeneralTimLiterasiController::class, 'batalKurasi'])->middleware('inovasi');
Route::get('/inovasi-detail-rohani/{siswa_id}', [GeneralTimLiterasiController::class, 'kerohanianDetail'])->middleware('inovasi');
Route::get('/inovasi-detail-kunjungan/{siswa_id}', [GeneralTimLiterasiController::class, 'kunjunganDetail'])->middleware('inovasi');
Route::get('/inovasi-detail-kegiatan/{siswa_id}', [GeneralTimLiterasiController::class, 'detailKegiatan'])->middleware('inovasi');
Route::get('/inovasi-ketercapaian-ekstensif', [GeneralTimLiterasiController::class, 'ketercapaianEkstensif'])->middleware('inovasi');
Route::get('/inovasi-ketercapaian-kerohanian', [GeneralTimLiterasiController::class, 'ketercapaianKerohanian'])->middleware('inovasi');
Route::get('/inovasi-ketercapaian-kunjungan', [GeneralTimLiterasiController::class, 'ketercapaianKunjungan'])->middleware('inovasi');
Route::get('/inovasi-ketercapaian-ukbi', [GeneralTimLiterasiController::class, 'ketercapaianUkbi'])->middleware('inovasi');

// Route Filter
Route::post('/filter-ekstensif', [GeneralTimLiterasiController::class, 'filterEkstensif'])->middleware('inovasi');
Route::post('/filter-ketercapaian-ekstensif', [GeneralTimLiterasiController::class, 'filterKetercapaianEkstensif'])->middleware('inovasi');
Route::post('/filter-rohani', [GeneralTimLiterasiController::class, 'filterKerohanian'])->middleware('inovasi');
Route::post('/filter-ketercapaian-rohani', [GeneralTimLiterasiController::class, 'filterKetercapaianKerohanian'])->middleware('inovasi');
Route::post('/filter-kunjungan', [GeneralTimLiterasiController::class, 'filterKunjungan'])->middleware('inovasi');
Route::post('/filter-ketercapaian-kunjungan', [GeneralTimLiterasiController::class, 'filterKetercapaianKunjungan'])->middleware('inovasi');
Route::post('/filter-karya', [GeneralTimLiterasiController::class, 'filterKarya'])->middleware('inovasi');
Route::post('/filter-ukbi', [GeneralTimLiterasiController::class, 'filterUkbi'])->middleware('inovasi');
Route::post('/filter-ketercapaian-ukbi', [GeneralTimLiterasiController::class, 'filterKetercapaianUkbi'])->middleware('inovasi');
Route::post('/filter-kegiatan', [GeneralTimLiterasiController::class, 'filterKegiatan'])->middleware('inovasi');


// Route Perpustakaan

Route::get('/tim-perpustakaan', [GeneralPerpustakaanController::class, 'index'])->middleware('perpus');
Route::get('/tim-perpustakaan/add', [GeneralPerpustakaanController::class, 'create'])->middleware('perpus');
Route::post('/tim-perpustakaan/add', [GeneralPerpustakaanController::class, 'store'])->middleware('perpus');
Route::get('/tim-perpustakaan/list', [GeneralPerpustakaanController::class, 'list'])->middleware('perpus');
Route::delete('/tim-perpustakaan/{id}', [GeneralPerpustakaanController::class, 'remove'])->middleware('perpus');
Route::get('/tim-perpustakaan/{kegiatan}', [GeneralPerpustakaanController::class, 'edit'])->middleware('perpus');
Route::put('/tim-perpustakaan/edit/{kegiatan}', [GeneralPerpustakaanController::class, 'update'])->middleware('perpus');
// CRUD PERPUSTKAAN
Route::resource('/perpustakaan', PerpustakaanController::class)->middleware('perpus');


Route::get('/tes', function () {
    return view('tim_literasi.Ekstensif.pilih-kelas');
});
