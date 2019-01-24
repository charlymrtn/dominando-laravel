@extends('layout')

@section('title','Usuarios')

@section('contenido')
    @if($usuario)
        <h1>Usuario {{$usuario->id}}</h1>
        <h2>{{$usuario->email}}</h2>
        <h3>{{$usuario->name}}</h3>
        <p>{{$usuario->rol}}</p>
    @else
        <h3>no existe este elemento</h3>
    @endif
@stop
