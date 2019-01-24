@extends('layout')

@section('title',isset($usuario) ? $usuario->name : 'Crear Usuario')

@section('contenido')
    <h1>{{isset($usuario) ? "Editar usuario $usuario->name" : 'Crear Usuario'}}</h1>
    <h2>{{isset($usuario) ? 'formato de edición' : 'Usuarios'}}</h2>
    @if(session()->has('info'))
        <div class="alert alert-success">
            {{session('info')}}
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
                {{--<input id="role" type="text" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" value="{{ old('role') }}" required>--}}
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
    </form>
@stop