<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store(){
    //funcion para cerrar sesion
        auth()->logout();
        return redirect()->route('login');
    }

}
