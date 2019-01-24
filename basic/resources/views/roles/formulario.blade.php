@extends('layout')

@section('title',isset($role) ? $role->name : 'Crear Rol')

@section('contenido')
    <h1>{{isset($role) ? "Editar rol $role->name" : 'Crear Rol'}}</h1>
    <h2>{{isset($role) ? 'formato de edición' : 'Roles'}}</h2>
    @if(session()->has('info') && request()->route()->named('roles.create'))
        <h1>{{session('info')}}</h1>
    @endif
    <form action="{{isset($role) ? route('roles.update',$role->id) : route('roles.store')}}" method="post">
        @csrf
        @if(isset($role))
            @method('put')
        @endif
        <p><label for="key">llave
                <input class="form-control" type="text" name="key" value="{{isset($role)? $role->key : old('key')}}">
                {!! $errors->first('key','<span class=error>:message</span>') !!}
            </label></p>
        <p><label for="name">nombre
                <input class="form-control" type="text" name="name" value="{{isset($role)? $role->name : old('name')}}">
                {!! $errors->first('name','<span class=error>:message</span>') !!}
            </label></p>
        <p><label for="mensaje">descripcion
                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{isset($role)? $role->description : old('description')}}</textarea>
                {!! $errors->first('description','<span class=error>:message</span>') !!}
            </label></p>

        <input class="btn btn-primary" type="submit" value="{{isset($role)?'editar':'guardar'}}">
    </form>
@stop


