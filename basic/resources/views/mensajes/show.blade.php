@extends('layout')

@section('title','Mensajes')

@section('contenido')
    @if($mensaje)
        <h1>Mensaje {{$mensaje->id}}</h1>
        <h2>{{$mensaje->correo}}</h2>
        <h3>{{$mensaje->nombre}}</h3>
        <p>{{$mensaje->mensaje}}</p>
        <br>
        <h4>Notas del mensaje</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nota</th>
            </tr>
            </thead>
            <tbody>
            @foreach($mensaje->notas as $nota)
                <tr>
                    <th scope="row">{{$nota->id}}</th>
                    <td>{{$nota->body}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @else
        <h3>no existe este elemento</h3>
    @endif
@stop
