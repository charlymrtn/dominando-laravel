@extends('layout')

@section('title','Usuarios')

@section('contenido')
    @if($usuario)
        <h1>Usuario {{$usuario->id}}</h1>
        <h2>{{$usuario->email}}</h2>
        <h3>{{$usuario->name}}</h3>
        <p>{{$usuario->role->name}}</p>
        @can('edit',$usuario)
            <a href="{{route('usuarios.edit',$usuario->id)}}" class="btn btn-primary pull-right">Editar</a>
            <br>
        @endcan
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
        <br>
        <h4>Notas del usuario {{$usuario->name}}</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nota</th>
            </tr>
            </thead>
            <tbody>
            @foreach($usuario->notas as $nota)
                <tr>
                    <th scope="row">{{$nota->id}}</th>
                    <td>{{$nota->body}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <h4>etiquetas del usuario {{$usuario->name}}</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
            </tr>
            </thead>
            <tbody>
            @foreach($usuario->tags as $tag)
                <tr>
                    <th scope="row">{{$tag->id}}</th>
                    <td>{{$tag->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @else
        <h3>no existe este elemento</h3>
    @endif
@stop
