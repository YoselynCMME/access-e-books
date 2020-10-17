<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/materials/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectPath(){
        if(auth()->user()->role->role == 'profesor' || auth()->user()->role->role == 'alumno')
            return 'materials/home';
        if(auth()->user()->role->role == 'administrador')
            return 'administrator/home';
    } 

    protected function credentials(Request $request) {
        $login = $request->input($this->username());
    
        // Comprobar si el input coincide con el formato de E-mail
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';
    
        return [
            $field => $login,
            'password' => $request->input('password')
        ];
    }
    
    public function username() {
        return 'login';
    }

    protected function authenticated($request, $user) { 
        auth()->logoutOtherDevices(request('password')); 
    }

    //Metodo logout para cerrar sesion, y nos ubique en la vista login
    public function logout(){
        auth()->logout(); //Para poder cerrar sesión de la aplicación
        session()->flush(); //Limpiar todas las sesiones
        return redirect('/login');
    }
}
