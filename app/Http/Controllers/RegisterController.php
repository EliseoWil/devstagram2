<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    
    public function store(Request $request){
        /* dd($request->get('username')); */
        /* dd ($request); */

        //Modificar el Request
        $request->request->add(['username' => Str::slug( $request->username)]);
        //=========================
        // VALIDACIONES
        //=========================
        $this->validate($request,[
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $request->name,
            /* 'username' => Str::lower( $request->username), */ //Esto junta caracteresy los pnde minusculas
            'username' => $request->username , //Esto junta caracteres y los espacios lo pone con gion
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        /* AUTENTICAR UN USUARIO */
        /* auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]); */

        /* OTRA FORMA DE AUTENTICAR */
        auth()->attempt($request->only('email','password'));

        // Redireccionar
        return redirect()->route('posts.index');
    }
}
