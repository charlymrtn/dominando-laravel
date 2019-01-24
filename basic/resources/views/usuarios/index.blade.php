@extends('layout')

@section('title','Usuarios')

@section('contenido')
    <h1>Hola {{auth()->user()->name}}</h1>
    <h2>Todos los Usuarios</h2>
    <p>
        <a href="{{route('usuarios.create')}}" class="btn btn-primary">Crear Usuario</a>
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
            <th>Correo</th>
            <th>Rol</th>
            <th colspan="2">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>
                        <a href="{{route('usuarios.show',$usuario->id)}}">
                            {{$usuario->id}}
                        </a>
                    </td>
                    <td>
                        {{$usuario->name}}
                    </td>
                    <td>
                        {{$usuario->email}}
                    </td>
                    <td>
                        {{$usuario->role->name}}
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{route('usuarios.edit',$usuario->id)}}">
                            Editar
                        </a>
                        <form method="post" style="display: inline" action="{{route('usuarios.destroy',$usuario->id)}}">
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
