@extends('layout')

@section('title','Zonas')

@section('contenido')
    @if($zona)
        <h1>Zona 110{{$zona->id}}</h1>
        <h2>{{$zona->entidad_tipo}}</h2>
        <h3>{{$zona->zonable_id}}</h3>
        <p>{{$zona->body}}</p>
        <br>
        <p>{{get_class($zona->entidad)}}</p>
        <h4>{{$zona->entidad_tipo}} de la zona S1-{{$zona->id}}</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Llave</th>
                <th scope="col">Nombre</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{$zona->entidad->id}}</th>
                <td>{{$zona->entidad->name}}</td>
                <td>{{$zona->entidad->key}}</td>
            </tr>
            </tbody>
        </table>

    @else
        <h3>no existe este elemento</h3>
    @endif
@stop
