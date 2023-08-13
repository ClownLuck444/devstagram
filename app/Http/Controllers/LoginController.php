<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view ('auth.login');
    }
    public function store(Request $request){
        //validar
        $this->validate($request,[
            'email'=>['required', 'email'],
            'password'=>['required']
        ]);
        //back vuelve a la pagina que se envio la informacion
        //with envia por medio de 'mensaje' la informacion
        if(!auth()->attempt($request->only('email','password'),$request->remember)){
         return back()->with('mensaje','Credenciales incorrectas Incorrectas');
         
        }
      
            return redirect()->route('post.index',auth()->user()->username);
        

    }
}
