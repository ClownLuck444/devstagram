@extends('layout.app')

@section ('titulo')
Pagina Principal
@endsection('titulo')

@section('contenido')

<x-listar-post :posts="$posts"/>


@endsection('contenido')