<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class LandingController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        return view('landing');
    }

    /**
     * Handle registration from landing page.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:dpmptsp,pd_teknis,penerbitan_berkas'],
        ]);

        // Cek apakah sudah ada admin
        $adminExists = User::where('role', 'admin')->exists();
        
        // Jika role yang dipilih adalah admin dan sudah ada admin, tolak
        if ($request->role === 'admin' && $adminExists) {
            return back()->withErrors(['role' => 'Role admin sudah ada dan tidak dapat dibuat lagi.']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
