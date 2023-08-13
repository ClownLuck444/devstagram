<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __invoke()
    {
//obtener a quienes seguimos
     //whereIn verifica un arreglo
     //where revisa un valor
     //latest muestra lo ultimo como primero en las publicaciones
$ids=auth()->user()->followings->pluck('id')->toArray();
$posts=Post::whereIn('user_id',$ids)->latest()->paginate(4);
        return view('home',[
            'posts'=>$posts
        ]);
       
    }
}
