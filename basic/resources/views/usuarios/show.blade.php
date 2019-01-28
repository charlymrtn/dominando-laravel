@extends('layout')

@section('title','Usuarios')

@section('contenido')
    @if($usuario)
        <h1>Usuario {{$usuario->id}}</h1>
        <h2>{{$usuario->email}}</h2>
        <h3>{{$usuario->name}}</h3>
        <p>{{$usuario->role->name}}</p>
        <br>
        <h4>Perfiles del usuario {{$usuario->name}}</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($usuario->perfiles as $perfil)
                <tr>
                    <th scope="row">{{$perfil->id}}</th>
                    <td>{{$perfil->key}}</td>
                    <td>{{$perfil->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @can('edit',$usuario)
            <a href="{{route('usuarios.edit',$usuario->id)}}" class="btn btn-primary">Editar</a>
            <br>
        @endcan
    @else
        <h3>no existe este elemento</h3>
    @endif
@stop
