@extends('layout')

@section('title',isset($mensaje) ? $mensaje->nombre : 'Contactános')

@section('contenido')
    <h1>{{isset($mensaje) ? "Editar mensaje $mensaje->id" : 'Zona de contacto'}}</h1>
    <h2>{{isset($mensaje) ? 'formato de edición' : 'escribeme'}}</h2>

    @if(isset($mensaje))
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNoteModal">
            Agregar nota
        </button>
        <br>
    @endif

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

    @if ($errors->any())
        <br>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{isset($mensaje) ? route('mensajes.update',$mensaje->id) : route('mensajes.store')}}" method="post">
        @csrf
        @if(isset($mensaje))
            @method('put')
        @endif

        @if(auth()->guest() || isset($mensaje))
            <p><label for="name">nombre
                    <input class="form-control" type="text" name="nombre"
                           value="{{isset($mensaje)? (isset($mensaje->usuario) ? $mensaje->usuario->name :$mensaje->nombre) : old('nombre')}}">
                    {!! $errors->first('nombre','<span class=error>:message</span>') !!}
                </label></p>
            <p><label for="email">email
                    <input class="form-control" type="email" name="correo"
                           value="{{isset($mensaje)? (isset($mensaje->usuario) ? $mensaje->usuario->email : $mensaje->correo) : old('correo')}}">
                    {!! $errors->first('correo','<span class=error>:message</span>') !!}
                </label></p>
        @endif
        <p><label for="telefono">telefono
                <input class="form-control" type="text" name="telefono"
                       value="{{isset($mensaje)? $mensaje->telefono : old('telefono')}}">
                {!! $errors->first('telefono','<span class=error>:message</span>') !!}
            </label></p>
        <p><label for="mensaje">mensaje
                <textarea class="form-control" name="mensaje" id="mensaje" cols="30" rows="10">{{isset($mensaje)? $mensaje->mensaje : old('mensaje')}}</textarea>
                {!! $errors->first('mensaje','<span class=error>:message</span>') !!}
            </label></p>

        <input class="btn btn-primary" type="submit" value="{{ isset($mensaje) ? 'editar' : 'guardar'}}">
    </form>

    @if(isset($mensaje))
        @include('layouts.modal')
    @endif
@stop


