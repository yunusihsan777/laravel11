<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return Inertia::render('Auth/Login');
    }

    // Menangani login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_satker' => 'required|string',
            'password' => 'required|string',
        ]);
    
        // Kredensial untuk login
        $credentials = [
            'id_satker' => $request->id_satker,
            'password' => $request->password,
        ];
    
        // Cek apakah kredensial valid
        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();
    
            // Ambil data pengguna yang sedang login
            $user = Auth::user();
    
            // Simpan data pengguna ke session jika diperlukan
            session([
                'id_satker' => $user->id_satker,
                'id_sakip_level' => $user->id_sakip_level,
            ]);
    
            // Redirect ke halaman dashboard atau halaman yang diminta sebelumnya
            return redirect()->intended('dashboard');
        }
    
        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'id_satker' => 'ID Satker atau Password yang dimasukkan salah.',
        ])->onlyInput('id_satker');
    }

    // Menangani logout
    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();
    
        // Invalidate session
        $request->session()->invalidate();
    
        // Regenerate CSRF token
        $request->session()->regenerateToken();
    
        // Redirect ke halaman login
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
