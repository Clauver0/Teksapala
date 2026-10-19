<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use App\Models\Komunitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    private const GUARDS = ['donatur', 'komunitas'];

    public function loginView()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Coba login sebagai donatur, kalau gagal coba sebagai komunitas
        foreach (self::GUARDS as $guard) {
            if (Auth::guard($guard)->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended(route('profil'));
            }
        }

        return back()->withInput($request->only('username'))
                     ->with('error', 'Username / password salah!');
    }

    public function registerView()
    {
        return view('auth.registrasi');
    }

    public function register(Request $request)
{
    $request->validate([
        // username harus unik di kedua tabel, karena login mengecek donatur lalu komunitas
        'username'  => 'required|max:50|unique:donatur,username|unique:komunitas,username',
        'password'  => 'required|min:3',
        'password2' => 'required|same:password',
    ], [
        'username.required'  => 'Username tidak boleh kosong!',
        'username.unique'    => 'Username ini sudah terdaftar.',
        'password.required'  => 'Password wajib diisi!',
        'password.min'       => 'Password minimal harus 3 karakter.',
        'password2.required' => 'Konfirmasi password tidak boleh kosong!',
        'password2.same'     => 'Konfirmasi password tidak sesuai dengan password utama.',
    ]);

    Donatur::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil!');
}

    public function logout(Request $request)
    {
        foreach (self::GUARDS as $guard) {
            Auth::guard($guard)->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function profile()
    {
        return view('profil.profil', ['user' => Auth::user()]);
    }

    public function editProfile()
    {
        return view('profil.profil-edit', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'display_name' => 'nullable|string|max:100',
            'profile_img'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'header_img'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $user->display_name = $request->display_name;

        foreach (['profile_img', 'header_img'] as $field) {
            if ($request->hasFile($field)) {
                if ($user->$field) {
                    Storage::disk('public')->delete($user->$field);
                }
                $user->$field = $request->file($field)->store($field, 'public');
            }
        }

        $user->save();

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
    }
}