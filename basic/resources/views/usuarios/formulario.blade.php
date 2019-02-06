@extends('layout')

@section('title',isset($usuario) ? $usuario->name : 'Crear Usuario')

@section('contenido')
    <h1>{{isset($usuario) ? "Editar usuario $usuario->name" : 'Crear Usuario'}}</h1>
    <h2>{{isset($usuario) ? 'formato de edición' : 'Usuarios'}}</h2>

    @if(isset($usuario))
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNoteModal">
            Agregar nota
        </button>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addTagModal">
            Agregar etiqueta
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
    @if($errors->has('perfiles'))
        <div class="alert alert-danger">
            {{$errors->first('perfiles')}}
        </div>
    @endif

    <form action="{{isset($usuario) ? route('usuarios.update',$usuario->id) : route('usuarios.store')}}" method="post">
        @csrf
        @if(isset($usuario))
            @method('put')
        @endif
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{isset($usuario)? $usuario->name : old('name')}}" required autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{isset($usuario)? $usuario->email : old('email')}}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

            <div class="col-md-6">
                <select name="role_id" id="role_id" class="form-control{{ $errors->has('role_id') ? ' is-invalid' : '' }}" required>
                    <option value="" disabled>Selecciona una opción</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}" {{ isset($usuario) && $usuario->role_id == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                    @endforeach
                </select>

                @if ($errors->has('role_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('role_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="perfiles" class="col-md-4 col-form-label text-md-right">{{ __('Perfiles') }}</label>

            <div class="col-md-6">
                @foreach($perfiles as $id => $name)
                    <div class="form-check">
                        <input class="form-check-input" value="{{$id}}" name="perfiles[]" type="checkbox" id="gridCheck{{$id}}"
                            {{isset($usuario) && $usuario->hasPerfil($id) ? 'checked' : ''}}>
                        <label class="form-check-label" for="gridCheck{{$id}}">
                            {{$name}}
                        </label>
                    </div>
                @endforeach

                @if ($errors->has('perfiles'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('perfiles') }}</strong>
                    </span>
                @endif
            </div>

        </div>

        @if(!isset($usuario))
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
        @endif

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ isset($usuario)?'Editar':__('Register') }}
                </button>
            </div>
        </div>
        <br>
        @if(isset($usuario))
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addNoteModal">
                        Agregar nota
                    </button>
                </div>
            </div>
        @endif
    </form>

    @if(isset($usuario))
        @include('layouts.modal-nota')
        @include('layouts.modal-tag')
    @endif
@stop
