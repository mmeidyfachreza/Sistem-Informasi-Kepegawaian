<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
    $this->validate($request, [
        'username' => 'required|string', //VALIDASI KOLOM USERNAME
        //TAPI KOLOM INI BISA BERISI EMAIL ATAU USERNAME
        'password' => 'required|string|min:6',
        'captcha' => 'required|captcha'
    ]);

    //LAKUKAN LOGIN
    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        //JIKA BERHASIL, MAKA REDIRECT KE HALAMAN HOME
        if (auth()->user()->tipe_user == "admin") {
            return redirect()->route('admin.home');
        }elseif (auth()->user()->tipe_user == "staff"){
            return redirect()->route('home');
        }

    }
    //JIKA SALAH, MAKA KEMBALI KE LOGIN DAN TAMPILKAN NOTIFIKASI
    throw ValidationException::withMessages([
        'username' => ['username/Password salah.'],
    ]);

    return redirect()->route('login')->with(['username' => 'Email/Password salah!']);
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    // public function username()
    // {
    //     return 'username';
    // }
}
