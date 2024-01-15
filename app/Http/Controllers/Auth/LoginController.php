<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function loginUrl(Request $request) 
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }
        $user = Auth::loginUsingId($request->user_id);
        return redirect($request->url);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login_corona');
    }

    public function showLoginFormClient()
    {
        return view('auth.login_corona_client');
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->akses == 'admin') {
            activity()->causedBy(Auth::user())
            ->event("login")
            ->log('admin '.auth()->user()->name.' melakukan login');
            return redirect()->route('admin.beranda');
        } elseif ($user->akses == 'client') {
            activity()->causedBy(Auth::user())
            ->event("login")
            ->log('client '.auth()->user()->name.' melakukan login');
            return redirect()->route('client.beranda');
        } else {
            Auth::logout();
            flash()->addError('Anda tidak memiliki hak akses');
            return redirect()->route('login');
        }
    }

    protected function loginApi(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'fcm_token' => 'nullable',
        ]);
        
        if (Auth::attempt($request->only('email', 'password'))) {
            if ($request->filled('fcm_token')) {
                Auth::user()->update(['fcm_token' => $request->fcm_token]);
            }
            $token = Auth::user()->createToken('authToken')->plainTextToken;
            $user = array_merge(Auth::user()->toArray(), ['token' => $token]);
            return $this->okResponse("Login berhasil", $user);
        }

        return $this->unauthenticatedResponse('Login gagal');
    }
}
