<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

     public function __construct()
     {
      //except es para que se muestre ciertas paginas
        $this->middleware('auth')->except(['show','index']);
     }
    public function index(User $user){
     //con get se trae los resultados, con paginate, solo aparecen 5 registros
      $posts=Post::where('user_id',$user->id)->latest()->paginate(4);
     return view ('dashboard',[
      'user'=>$user,
      'posts'=>$posts
     ]);
   }
     public function create(){
       return view ('posts.create');

     }
     public function store(Request $request){
        
      $this->validate($request,[
        'titulo'=>'required|max:255',
        'descripcion' => 'required',
        'imagen'=>'required',
      ]);
      //insert into
      Post::create([
        'titulo'=>$request->titulo,
        'descripcion'=>$request ->descripcion,
        'imagen'=>$request->imagen,
        'user_id'=>auth()->user()->id
      ]);

//otra forma de introducir datos
/*$request->user()->posts()->create([
  'titulo'=>$request->titulo,
  'descripcion'=>$request ->descripcion,
  'imagen'=>$request->imagen,
  'user_id'=>auth()->user()->id
]);
    */  
      return redirect()->route('post.index',auth()->user()->username);
     }
        public function show(User $user, Post $post){
          return view('posts.show',[
            'post'=>$post,
            'user'=>$user
          ]);
        }
        public function destroy(Post $post){
         $this->authorize('delete',$post);
          $post->delete();
              //eliminar imagen, nos va dar la url 
              $imagenPath=public_path('uploads/' .$post->imagen);
              if(File::exists($imagenPath)){
                unlink($imagenPath);
              }

          return redirect()->route('post.index',auth()->user()->username);
         }
        }
    

