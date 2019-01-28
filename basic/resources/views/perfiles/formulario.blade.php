@extends('layout')

@section('title',isset($perfil) ? $perfil->name : 'Crear Perfil')

@section('contenido')
    <h1>{{isset($perfil) ? "Editar perfil $perfil->name" : 'Crear Perfil'}}</h1>
    <h2>{{isset($perfil) ? 'formato de edición' : 'Perfiles'}}</h2>
    @if(session()->has('info') && request()->route()->named('perfiles.create'))
        <h1>{{session('info')}}</h1>
    @endif
    <form action="{{isset($perfil) ? route('perfiles.update',$perfil->id) : route('perfiles.store')}}" method="post">
        @csrf
        @if(isset($perfil))
            @method('put')
        @endif
        <p><label for="key">llave
                <input class="form-control" type="text" name="key" value="{{isset($perfil)? $perfil->key : old('key')}}">
                {!! $errors->first('key','<span class=error>:message</span>') !!}
            </label></p>
        <p><label for="name">nombre
                <input class="form-control" type="text" name="name" value="{{isset($perfil)? $perfil->name : old('name')}}">
                {!! $errors->first('name','<span class=error>:message</span>') !!}
            </label></p>
        <p><label for="mensaje">descripcion
                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{isset($perfil)? $perfil->description : old('description')}}</textarea>
                {!! $errors->first('description','<span class=error>:message</span>') !!}
            </label></p>

        <input class="btn btn-primary" type="submit" value="{{isset($perfil)?'editar':'guardar'}}">
    </form>
@stop


