@extends('layout')

@section('title',isset($nota) ? 'Nota 110'.$nota->id : 'Crear Nota')

@section('contenido')
    <h1>{{isset($nota) ? "Editar nota 110$nota->id" : 'Crear Nota'}}</h1>
    <h2>{{isset($nota) ? 'formato de edición' : 'Notas'}}</h2>

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

    <form action="{{isset($nota) ? route('notas.update',$nota->id) : route('notas.store')}}" method="post">
        @csrf
        @if(isset($nota))
            @method('put')
            <p>
                <label for="entidad">Entidad
                    <input class="form-control" type="text" name="entidad" value="{{$nota->entidad_tipo}}" readonly>
                </label>
            </p>
            <p>
                <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$nota->entidad_tipo}} {{$nota->entidad->id}}</h5>
                            <p class="card-text">{{$nota->entidad->name}}</p>
                            <p class="card-text">{{$nota->entidad->email}}</p>
                            @if($nota->entidad_tipo == 'Mensaje')
                                <p class="card-text">{{$nota->entidad->mensaje}}</p>
                            @endif
                            <a href="{{route($nota->entidad_tipo == 'Mensaje' ? 'mensajes.show' : 'usuarios.show',$nota->entidad->id)}}" class="btn btn-primary">Ver Entidad</a>
                        </div>
                </div>
            </p>
        @else
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
        @endif

        <p>
            <label for="body">Texto
                <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{isset($nota)? $nota->body : old('body')}}</textarea>
                {!! $errors->first('body','<span class=error>:message</span>') !!}
            </label>
        </p>

        <input class="btn btn-primary" type="submit" value="{{isset($nota)?'editar':'guardar'}}">
    </form>

@stop


