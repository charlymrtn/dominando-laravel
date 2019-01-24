@extends('layout')

@section('title','Home Page')

@section('contenido')
    <h1>Home Page</h1>
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
@stop
