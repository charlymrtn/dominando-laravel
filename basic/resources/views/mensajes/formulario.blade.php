@extends('layout')

@section('title',isset($mensaje) ? $mensaje->nombre : 'Contactános')

@section('contenido')
    <h1>{{isset($mensaje) ? "Editar mensaje $mensaje->id" : 'Zona de contacto'}}</h1>
    <h2>{{isset($mensaje) ? 'formato de edición' : 'escribeme'}}</h2>
    @if(session()->has('info') && request()->route()->named('mensajes.create'))
        <h1>{{session('info')}}</h1>
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
@stop


