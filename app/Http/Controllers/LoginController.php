<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function viewSiswa()
    {
        return view('login_siswa');
    }

    public function viewGuru()
    {
        return view('login_guru');
    }

    public function loginSiswa(Request $request)
    {

        // FUngsi jika sebelumnya guru login
        Auth::guard('guru')->logout();

        $credentials = $request->validate([
            'nomor_induk' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('siswa')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/ekstensif/create');
        }

        return back()->with('error', 'Nomor Induk atau password salah');
    }

    public function loginGuru(Request $request)
    {
        // Fungsi logout siswa jika sebelumnya siswa login
        Auth::guard('siswa')->logout();


        $credentials = $request->validate([
            'nip' => ['required'],
            'password' => ['required'],
        ]);
        $credentials['nip'] = str_replace(" ", "", $request->input('nip'));

        $role = $request->input('role');

        if (Auth::guard('guru')->attempt($credentials)) {
            $request->session()->regenerate();

            if($role){
                if(Auth::guard('guru')->user()->admin && $role == 'admin'){
                    return redirect()->intended('/admin-dashboard');
                }else if(Auth::guard('guru')->user()->walas && $role == 'walas'){
                    return redirect()->intended('/walas-ekstensif');
                }else if(Auth::guard('guru')->user()->inovasi && $role == 'inovasi'){
                    return redirect()->intended('/tugas-literasi');
                }elseif(Auth::guard('guru')->user()->perpustakaan && $role == "perpustakaan"){
                    return redirect()->intended('/tim-perpustakaan');
                }
            }

            if (Auth::guard('guru')->user()->admin) {
                return redirect()->intended('/admin-dashboard');
            } else if (Auth::guard('guru')->user()->walas) {
                return redirect()->intended('/walas-ekstensif');
            } else if (Auth::guard('guru')->user()->inovasi) {
                return redirect()->intended('/tugas-literasi');
            } else if (Auth::guard('guru')->user()->perpustakaan) {
                return redirect()->intended('/tim-perpustakaan');
            }
        } else {
            return back()->with('error', 'NIP Atau Password Salah');
        }
    }

    public function changePassSiswa()
    {
        return view('siswa.ganti_password');
    }
    public function changePassAdmin()
    {
        return view('admin.ganti_password');
    }
    public function changePassPerpus()
    {
        return view('perpustakaan.ganti_password');
    }
    public function changePassLiterasi()
    {
        return view('tim_literasi.ganti_password');
    }
    public function changePassWalas()
    {
        return view('walas.ganti_password');
    }

    public function changePassword(Request $request)
    {
        $password = null;
        try {
            $password = auth()->guard('guru')->user()->password;
        } catch (Exception $e) {
        }
        try {
            $password = auth()->guard('siswa')->user()->password;
        } catch (Exception $e) {
        }
        if (Hash::check($request->password_lama, $password)) {
            if (auth()->guard('siswa')->check()) {
                Siswa::where('id', auth()->guard('siswa')->user()->id)
                    ->update([
                        'password' => bcrypt($request->password_baru)
                    ]);
                return redirect()->back()->with('success', 'Password Diganti');
            } elseif (auth()->guard('guru')->check()) {
                Guru::where('id', auth()->guard('guru')->user()->id)
                    ->update([
                        'password' => bcrypt($request->password_baru)
                    ]);
                return redirect()->back()->with('success', 'Password Diganti');
            }
        } else {
            return redirect()->back()->with('error', 'Password Lama Salah');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('guru')->logout();
        Auth::guard('siswa')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
