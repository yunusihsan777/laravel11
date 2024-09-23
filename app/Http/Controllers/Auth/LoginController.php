<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth/login');
    }

    // Menangani login
    public function login(Request $request)
{
    $request->validate([
        'id_satker' => 'required',
        'satkerpass' => 'required',
    ]);

    $id_satker = $request->input('id_satker');
    $satkerpass = $request->input('sakterpass');

    // Fetch user from database
    $user = DB::table('sinori_login')->where('id_satker', $id_satker)->first();

    // Check if user exists and password is correct
    if ($user && md5($satkerpass) === $user->satkerpass) {
        // Store user data in session
        $request->session()->put('id_satker', $user->id_satker);
        $request->session()->put('satkernama', str_replace('_', ' ', $user->satkernama));

        // Mark the user as logged in manually
        auth()->loginUsingId($user->id_satker);

        return redirect()->route('dashboard');
    }

    return back()->withErrors(['id_satker' => 'Invalid credentials']);
}


    // Menangani logout
    public function logout(Request $request)
    {
        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect('/');
    }
}
