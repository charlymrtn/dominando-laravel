@extends('layout')

@section('title',isset($tag) ? 'Etiqueta T1-'.$tag->id : 'Crear Etiqueta')

@section('contenido')

    <h1>{{isset($tag) ? "Editar nota 110$tag->id" : 'Crear Nota'}}</h1>
    <h2>{{isset($tag) ? 'formato de edición' : 'Notas'}}</h2>

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
    <form action="{{isset($tag) ? route('etiquetas.update',$tag->id) : route('etiquetas.store')}}" method="post">
        @csrf
        @if(isset($tag))
            @method('put')

            <p>
                <label for="name">Nombre
                    <input class="form-control" type="text" name="name" value="{{$tag->name}}">
                </label>
                <input class="btn btn-primary" type="submit" value="editar">
            </p>

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
            <p>
                <label for="name">Nombre
                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                </label>
                {!! $errors->first('name','<span class=error>:message</span>') !!}
            </p>

            <p>
            <div class="input-group mb-2 col-md-4">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="entidad">Entidad</label>
                </div>
                <select class="custom-select entidad-select" name="entidad" id="entidad">
                    <option disabled selected>Escoge...</option>
                    <option value="users">Usuario</option>
                    <option value="mensajes">Mensaje</option>
                </select>
                {!! $errors->first('entidad','<span class=error>:message</span>') !!}
            </div>
            </p>
            <p>
            <div class="input-group mb-2 col-md-4">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="identificador">Identificador</label>
                </div>
                <select class="selectpicker" id="identificador" name="identificador">
                    <option value="0" disabled selected>Escoge...</option>
                </select>

                {!! $errors->first('identificador','<span class=error>:message</span>') !!}
            </div>
            </p>
            <input class="btn btn-primary" type="submit" value="guardar">
        @endif

    </form>

@stop


