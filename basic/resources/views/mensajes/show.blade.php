@extends('layout')

@section('title','Mensajes')

@section('contenido')
    @if($mensaje)
        <h1>Mensaje {{$mensaje->id}}</h1>
        <h2>{{$mensaje->correo}}</h2>
        <h3>{{$mensaje->nombre}}</h3>
        <p>{{$mensaje->mensaje}}</p>
    @else
        <h3>no existe este elemento</h3>
    @endif
@stop
