@extends('layout')

@section('title','Perfiles')

@section('contenido')
    <h1>Hola {{Auth::user()->name}}</h1>
    <h2>Todos los perfiles</h2>
    <p>
        <a href="{{route('perfiles.create')}}" class="btn btn-primary">Perfil Rol</a>
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
            <th>Etiqueta</th>
            <th>Descripción</th>
            <th colspan="2">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach($perfiles as $perfil)
                <tr>
                    <td>
                        <a href="{{route('perfiles.show',$perfil->id)}}">
                            {{$perfil->id}}
                        </a>
                    </td>
                    <td>
                        {{$perfil->key}}
                    </td>
                    <td>
                        {{$perfil->name}}
                    </td>
                    <td>
                        {{$perfil->description}}
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{route('perfiles.edit',$perfil->id)}}">
                            Editar
                        </a>
                        <form method="post" style="display: inline" action="{{route('perfiles.destroy',$perfil->id)}}">
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
