@extends('layouts.app')
@section('titulo')
    Página principaaaaaal
@endsection
@section('contenido')

<x-listar-post :posts="$posts"/>

{{-- SEGUNDA FORMA --}}
{{-- @forelse ($posts as $post)
<h1>{{ $post->titulo }}</h1>
@empty
<p>no hay</p>
@endforelse --}}

@endsection
