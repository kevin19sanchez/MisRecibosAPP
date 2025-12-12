<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function indexAuht(){
        return view('auth.login');
    }

    public function indexRegister(){
        return view('auth.register.register');
    }

    public function register(Request $request){
        $createuser = new Usuario;
        $createuser->name = $request->name;
        $createuser->email = $request->email;
        $createuser->password = $request->password;

        //dd($createuser);

        $createuser->save();

        return back()->with('mensaje', 'Usuario Registrado!!');
    }

    public function login(Request $request){
        $credentaials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentaials, $request->filled('remember'))){
            $request->session()->regenerate();
            return redirect()->intended('/dash');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput();
    }

    // Logout
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
