@extends('layout.app')

@section('titulo')

Inicio de sesion en Devstagram
@endsection

@section('contenido')
<div class="md:flex md:justify-center md:gap-10 items-center">
<div class= "md:w-6/12 p-5">
 <img src ="{{asset('img/login.jpg')}}" alt="imagenLogin">
</div>
<div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl" >
    <!-- novalidate anula la validacion de html -->
<form method="POST" action="{{route('login')}}" novalidate>
    @csrf
<!-- si esta mal ingresado el pass y el email retornar el mensaje-->
    @if(session('mensaje'))
    <p class ="bg-red-500 text-white my-2  rounded-lg 
    text-sm p-2 text-center">
    {{session('mensaje')}}
    </p>
    @endif
    <div class= "mb-5">
        <label for="email" class ="mb-2 block uppercase text-gray-500 font-bold">
           Correo
        </label>
        <input 
        id="email"
        name="email"
        type="email"
        placeholder="Tu email de registro"
        class="border p-3 w-full rounded-lg @error('email') border-red-500
        @enderror"
        value ="{{old('email')}}"
        />
        @error('email')
        <p class ="bg-red-500 text-white my-2  rounded-lg 
        text-sm p-2 text-center">{{$message}}</p>
    @enderror
    </div>
    <div class= "mb-5">
        <label for="password" class ="mb-2 block uppercase text-gray-500 font-bold">
          Contraseña
        </label>
        <input 
        id="password"
        name="password"
        type="password"
        placeholder="Contraseña de Registro"
        class="border p-3 w-full rounded-lg @error('password') border-red-500
        @enderror"
        />
        @error('password')
        <p class ="bg-red-500 text-white my-2  rounded-lg 
        text-sm p-2 text-center">{{$message}}</p>
    @enderror
    </div>
    <div class="mb-5">
        <input type="checkbox" name="remember"><label class=" text-gray-500
        text-sm"> Mantener mi sesion abierta</label>
    </div>
    <input 
    type="submit"
    value="Iniciar Sesion"
    class= "bg-green-500 hover:bg-sky-700 transition-colors cursor-pointer
    uppercase font-bold w-full p-3 text-white rounded-lg"
    />
</form>
</div>
</div>

@endsection