@extends('layout.app')

@section('titulo')
{{$post->titulo}}
@endsection
@section('contenido')
<div class="container mx-auto flex">
<div class="md:w-1/2">
    <img src="{{asset ('uploads') .'/' . $post->imagen}}" alt="Imagen del post" {{$post->titulo}}>
<div class="p-3 flex items-center gap-4">
    @auth
   
    <livewire:like-post :post="$post" />
 
    @endauth

</div>
<div>
    <a href="{{route('post.index',$user)}}">
    <p class="font-bold">{{$post->user->username}}</p>
    </a>
    <p class="text-sm text-gray-500">
        <!--api carbon funciona con diffForHumans-->
    {{$post->created_at->diffForHumans()}}
    </p>
    <p class="mt-5">
   {{$post->descripcion}}
    </p>
</div>
@auth
    @if ($post->user_id==auth()->user()->id)  
<form action="{{route('posts.destroy',$post)}}" method="POST">
    <!--METODO SPOOFING-->
    @method('DELETE')
    @csrf
    <input type="submit"
    value="Eliminar publicacion"
    class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
    />
</form>
@endif
@endauth
</div>

<div class="md:w-1/2 p-5">
    @auth
<div class="shadow bg-white p-7 mb-5">
    <p class="text-2xl font-bold text-center mb-4">Agregar un comentario</p>
    @if (session('mensaje'))
    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
        {{session('mensaje')}}
    </div>
    @endif    

    <form action="{{route ('comentarios.store',['post'=>$post,'user'=>$user])}}" method="POST">
        @csrf
        <div class= "mb-5">
            <label for="comentario" class ="mb-2 block uppercase text-gray-500 font-bold">
                Añadir comentario
            </label>
            <textarea 
            id="comentario"
            name="comentario"
            placeholder="Agregar un comentario"
            class="border p-3 w-full rounded-lg @error('descripcion') border-red-500
            @enderror"
            ></textarea>
            @error('comentario')
                <p class ="bg-red-500 text-white my-2  rounded-lg 
                text-sm p-2 text-center">{{$message}}</p>
            @enderror
        </div>
        <input 
    type="submit"
    value="Comentar"
    class= "bg-green-500 hover:bg-sky-700 transition-colors cursor-pointer
    uppercase font-bold w-full p-3 text-white rounded-lg"
    />
    </form>  
    @endauth
    <div class="bg-white shadow mb-5 max-h-96 overflow mt-10">
       @if ($post->comentarios->count())
       @foreach ($post->comentarios as $comentario )
           <div class="p-5 border-gray-300 border-b">
            <a href="{{route("post.index",$comentario->user)}}"class="font-bold ">
                {{$comentario->user->username}}
            </a>
            <p>{{$comentario->comentario}}
            <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}
           </div>
       @endforeach
           @else
           <p class="p-10 text-center">No hay comentarios</p>
       @endif
    </div>
</div>

</div>

</div>
@endsection