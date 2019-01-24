@extends('layout')

@section('title','Roles')

@section('contenido')
    @if($role)
        <h1>Rol {{$role->id}}</h1>
        <h2>{{$role->key}}</h2>
        <h3>{{$role->name}}</h3>
        <p>{{$role->description}}</p>
        <br>
        <h4>Usuarios del rol {{$role->name}}</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Correo</th>
            </tr>
            </thead>
            <tbody>
            @foreach($role->users as $usuario)
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
