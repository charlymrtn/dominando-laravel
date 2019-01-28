@extends('layout')

@section('title','Perfiles')

@section('contenido')
    @if($perfil)
        <h1>Rol {{$perfil->id}}</h1>
        <h2>{{$perfil->key}}</h2>
        <h3>{{$perfil->name}}</h3>
        <p>{{$perfil->description}}</p>
        <br>
        <h4>Usuarios del perfil {{$perfil->name}}</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Correo</th>
            </tr>
            </thead>
            <tbody>
            @foreach($perfil->usuarios as $usuario)
                <tr>
                    <th scope="row">{{$usuario->id}}</th>
                    <td>{{$usuario->name}}</td>
                    <td>{{$usuario->email}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h3>no existe este elemento</h3>
    @endif
@stop
