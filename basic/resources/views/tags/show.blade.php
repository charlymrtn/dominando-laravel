@extends('layout')

@section('title','Etiquetas')

@section('contenido')
    @if($tag)
        <h1>Etiqueta T1-{{$tag->id}}</h1>
        <h2>{{$tag->name}}</h2>

        <br>

        <div class="row">
            <div class="col-md-6">
                <p>
                <h3>Usuarios de la etiqueta</h3>
                @foreach($tag->usuarios as $user)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$user->id}}</h5>
                            <p class="card-text">{{$user->name}}</p>
                            <p class="card-text">{{$user->email}}</p>
                            <a href="{{route('usuarios.show',$user->id)}}" class="btn btn-primary">Ver Usuario</a>
                        </div>
                    </div>
                    @endforeach
                    </p>
            </div>
            <div class="col-md-6">
                <p>
                <h3>Mensajes de la etiqueta</h3>
                @foreach($tag->mensajes as $mensaje)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$mensaje->id}}</h5>
                            <p class="card-text">{{$mensaje->name}}</p>
                            <p class="card-text">{{$mensaje->email}}</p>
                            <p class="card-text">{{$mensaje->mensaje}}</p>
                            <a href="{{route('mensajes.show',$mensaje->id)}}" class="btn btn-primary">Ver Mensaje</a>
                        </div>
                    </div>
                    @endforeach
                    </p>
            </div>
        </div>

    @else
        <h3>no existe este elemento</h3>
    @endif
@stop
