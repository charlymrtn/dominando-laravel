@extends('layout')

@section('title','Roles')

@section('contenido')
    <h1>Hola {{Auth::user()->name}}</h1>
    <h2>Todos los roles</h2>
    <p>
        <a href="{{route('roles.create')}}" class="btn btn-primary">Crear Rol</a>
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
            @foreach($roles as $role)
                <tr>
                    <td>
                        <a href="{{route('roles.show',$role->id)}}">
                            {{$role->id}}
                        </a>
                    </td>
                    <td>
                        {{$role->key}}
                    </td>
                    <td>
                        {{$role->name}}
                    </td>
                    <td>
                        {{$role->description}}
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{route('roles.edit',$role->id)}}">
                            Editar
                        </a>
                        <form method="post" style="display: inline" action="{{route('roles.destroy',$role->id)}}">
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
