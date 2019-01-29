@extends('layout')

@section('title','Notas')

@section('contenido')
    @if($nota)
        <h1>Nota 110{{$nota->id}}</h1>
        <h2>{{$nota->entidad_tipo}}</h2>
        <h3>{{$nota->notable_id}}</h3>
        <p>{{$nota->body}}</p>
        <br>
        <p>{{get_class($nota->entidad)}}</p>
        <h4>{{$nota->entidad_tipo}} de la nota 110{{$nota->id}}</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Correo</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{$nota->entidad->id}}</th>
                <td>{{$nota->entidad->name}}</td>
                <td>{{$nota->entidad->email}}</td>
            </tr>
            </tbody>
        </table>

    @else
        <h3>no existe este elemento</h3>
    @endif
@stop
