@extends('layout')

@section('title','Zonas')

@section('contenido')
    <h1>Hola {{Auth::user()->name}}</h1>
    <h2>Todas las zonas</h2>
    <p>
        <a href="{{route('zonas.create')}}" class="btn btn-primary">Crear Zona</a>
    </p>
    @if(session()->has('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <table width="70%" border="1" class="text-center">
        <thead>
        <tr>
            <th>ID</th>
            <th>Llave</th>
            <th>Nombre</th>
            <th>ID de la entidad</th>
            <th>Tipo de Entidad</th>
            <th colspan="2">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach($zonas as $zona)
                <tr>
                    <td>
                        <a href="{{route('zonas.show',$zona->id)}}">
                            S1-{{$zona->id}}
                        </a>
                    </td>
                    <td>
                       {{$zona->key}}
                    </td>
                    <td>
                        {{$zona->name}}
                    </td>
                    <td>
                        <a href="{{route($zona->entidad_tipo ==='Role' ? 'roles.show':'perfiles.show',$zona->zonable_id)}}">
                            {{$zona->zonable_id}}
                        </a>
                    </td>
                    <td>
                        {{$zona->entidad_tipo}}
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{route('zonas.edit',$zona->id)}}">
                            Editar
                        </a>
                        <form method="post" style="display: inline" action="{{route('zonas.destroy',$zona->id)}}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
@stop
