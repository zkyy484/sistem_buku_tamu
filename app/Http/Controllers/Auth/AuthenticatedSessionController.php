<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    // funsi untuk menampilkan halaman login
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        if (!auth()->user()->is_active) {
            auth()->logout();

            return back()
                ->withErrors([
                    'email' => 'Akun dinonaktifkan admin'
                ]);
        }
        

        $request->session()->regenerate();

        $user = auth()->user();

        if ($user->role->nama_role == 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($user->role->nama_role == 'pegawai') {
            return redirect('/pegawai/dashboard');
        }

        if ($user->role->nama_role == 'pimpinan') {
            return redirect('/pimpinan/dashboard');
        }

        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
