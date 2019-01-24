@extends('layout')

@section('title','Saludos')

@section('contenido')
    <h1>Saludos a {{$nombre}}</h1>

    @forelse($consolas as $consola)
        <li>{{$consola}}</li>
    @empty
        <p>No hay consolas. </p>
    @endforelse
@stop
