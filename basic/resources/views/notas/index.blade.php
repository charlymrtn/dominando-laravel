@extends('layout')

@section('title','Notas')

@section('contenido')
    <h1>Hola {{Auth::user()->name}}</h1>
    <h2>Todas las notas</h2>
    <p>
        <a href="{{route('notas.create')}}" class="btn btn-primary">Crear Nota</a>
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
            <th>ID de la entidad</th>
            <th>Tipo de Entidad</th>
            <th>Cuerpo</th>
            <th colspan="2">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach($notas as $nota)
                <tr>
                    <td>
                        <a href="{{route('notas.show',$nota->id)}}">
                            110{{$nota->id}}
                        </a>
                    </td>
                    <td>
                        <a href="{{route($nota->entidad_tipo ==='User' ? 'usuarios.show':'mensajes.show',$nota->notable_id)}}">
                            {{$nota->notable_id}}
                        </a>
                    </td>
                    <td>
                        {{$nota->entidad_tipo === 'User' ? 'Usuario' : $nota->entidad_tipo}}
                    </td>
                    <td>
                        {{$nota->body}}
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{route('notas.edit',$nota->id)}}">
                            Editar
                        </a>
                        <form method="post" style="display: inline" action="{{route('notas.destroy',$nota->id)}}">
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
