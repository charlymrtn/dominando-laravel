@extends('layout')

@section('title','Mensajes')

@section('contenido')
    <h1>Bandeja de Entrada</h1>
    <h2>Todos los mensajes</h2>
    @if(session()->has('info'))
        <h4 style="color: green;">{{session('info')}}</h4>
    @endif
    <table width="70%" border="1" class="text-center">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Mensaje</th>
            <th colspan="2">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach($mensajes as $mensaje)
                <tr>
                    <td>{{$mensaje->id}}</td>

                    @if($mensaje->usuario)
                        <td><a href="{{route('usuarios.show',$mensaje->usuario->id)}}">{{$mensaje->usuario->name}}</a></td>
                        <td>{{$mensaje->usuario->email}}</td>
                    @else
                        <td>{{$mensaje->nombre}}</td>
                        <td>{{$mensaje->correo}}</td>
                    @endif

                    <td>
                        <a href="{{route('mensajes.show',$mensaje->id)}}">
                            {{$mensaje->mensaje}}
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{route('mensajes.edit',$mensaje->id)}}">
                            Editar
                        </a>
                        <form method="post" style="display: inline" action="{{route('mensajes.destroy',$mensaje->id)}}">
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
