@extends('layout')

@section('title',isset($zona) ? 'Zona S1-'.$zona->id : 'Crear Zona')

@section('contenido')
    <h1>{{isset($zona) ? "Editar zona S1-$zona->id" : 'Crear Zona'}}</h1>
    <h2>{{isset($zona) ? 'formato de edición' : 'Zonas'}}</h2>

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

    <form action="{{isset($zona) ? route('zonas.update',$zona->id) : route('zonas.store')}}" method="post">
        @csrf
        @if(isset($zona))
            @method('put')
        @endif
        @if(isset($zona))
            <p>
                <label for="entidad">Entidad
                    <input class="form-control" type="text" name="entidad" value="{{$zona->entidad_tipo}}" readonly>
                </label>
            </p>
            <p>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$zona->entidad_tipo}} {{$zona->entidad->id}}</h5>
                        <p class="card-text">{{$zona->entidad->key}}</p>
                        <p class="card-text">{{$zona->entidad->name}}</p>
                        <p class="card-text">{{$zona->entidad->description}}</p>
                        <a href="{{route($zona->entidad_tipo == 'Perfil' ? 'perfiles.show' : 'roles.show',$zona->entidad->id)}}"
                           class="btn btn-primary">Ver Entidad</a>
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
                    <option value="roles">Role</option>
                    <option value="perfiles">Perfil</option>
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
            <label for="key">llave
                <input class="form-control" type="text" name="key" value="{{isset($zona)? $zona->key : old('key')}}">
                {!! $errors->first('key','<span class=error>:message</span>') !!}
            </label>
        </p>
        <p>
            <label for="name">Nombre
                <input class="form-control" type="text" name="name" value="{{isset($zona)? $zona->name : old('name')}}">
                {!! $errors->first('name','<span class=error>:message</span>') !!}
            </label>
        </p>

        <input class="btn btn-primary" type="submit" value="{{isset($zona)?'editar':'guardar'}}">
    </form>

@stop


