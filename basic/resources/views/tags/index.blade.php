@extends('layout')

@section('title','Tags')

@section('contenido')
    <h1>Hola {{Auth::user()->name}}</h1>
    <h2>Todas las etiquetas</h2>
    <p>
        <a href="{{route('etiquetas.create')}}" class="btn btn-primary">Crear Etiqueta</a>
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
            <th>Nombre</th>
            <th>Mensajes</th>
            <th>Usuarios</th>
            <th colspan="2">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>
                        <a href="{{route('etiquetas.show',$tag->id)}}">
                            T1-{{$tag->id}}
                        </a>
                    </td>
                    <td>
                       {{$tag->name}}
                    </td>
                    <td>
                        {{$tag->mensajes()->count()}}
                    </td>
                    <td>
                        {{$tag->usuarios()->count()}}
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{route('etiquetas.edit',$tag->id)}}">
                            Editar
                        </a>
                        <form method="post" style="display: inline" action="{{route('etiquetas.destroy',$tag->id)}}">
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
