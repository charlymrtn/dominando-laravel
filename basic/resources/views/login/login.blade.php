@extends('layout')

@section('title','ingresa')

@section('contenido')
<h1>Ingresar</h1>
@if(session()->has('error'))
    <h4 style="color: red;">{{session('error')}}</h4>
    @endif
<form class="form-inline" action="{{route('login.post')}}" method="post">
    @csrf
    <input class="form-control" type="email" name="email" placeholder="correo" value="{{old('correo')}}">
    {!! $errors->first('correo','<span class=error>:message</span>') !!}

    <input class="form-control" type="password" name="password" placeholder="contraseña">
    {!! $errors->first('password','<span class=error>:message</span>') !!}
    <input type="submit" class="btn btn-primary" value="Entrar">

</form>
@stop
