<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>@yield('title','Mi Sitio')</title>
</head>
<body>

<header>
    @php
        function active($url){
            return request()->is($url) ? 'active' : '';
            }
    @endphp
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <a class="navbar-brand" href="{{route('index')}}">Inicio</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                    <li class="nav-item {{active('saludos/*')}}">
                        <a class="nav-link" href="{{route('saludo','carlos')}}">Saludos</a>
                    </li>
                    <li class="nav-item {{active('mensajes/crear')}}">
                        <a class="nav-link" href="{{route('mensajes.create')}}">Contacto</a>
                    </li>
                    @auth
                        <li class="nav-item {{active('mensajes*')}}">
                            <a class="nav-link" href="{{route('mensajes.index')}}">Mensajes</a>
                        </li>
                        @if(Auth::user()->hasRoles(['admin']))

                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Opciones
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item {{active('usuarios*')}}" href="{{route('usuarios.index')}}">Usuarios</a>
                                    <a class="dropdown-item {{active('roles*')}}" href="{{route('roles.index')}}">Roles</a>
                                    <a class="dropdown-item {{active('perfiles*')}}" href="{{route('perfiles.index')}}">Perfiles</a>
                                    <a class="dropdown-item {{active('notas*')}}" href="{{route('notas.index')}}">Notas</a>
                                    {{--<a class="dropdown-item {{active('zonas*')}}" href="{{route('zonas.index')}}">Zonas</a>--}}
                                </div>
                            </div>
                        @endif
                        <li class="nav-item dropdown pull-right">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{auth()->user()->name}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('usuarios.edit',auth()->user()->id)}}">Mi Perfil</a>
                                <form style="display: inline;" action="{{route('logout')}}" method="post">
                                    @csrf
                                    <input style="color: darkgreen" class="btn btn-link" type="submit" value="Salir">
                                </form>
                            </div>
                        </li>

                    @else
                        <li class="nav-item {{active('login')}}">
                            <a class="nav-link" href="{{route('login')}}">Ingresar</a>
                        </li>
                        <li class="nav-item {{active('register')}}">
                            <a class="nav-link" href="{{route('register')}}">Registrarse</a>
                        </li>

                    @endauth
                </ul>
            </div>
        </nav>
</header>
<div class="container">
    @yield('contenido')
    <br>
    <footer>Copyright {{date('Y')}}</footer>
</div>

{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

@include('layouts.js')

</body>
</html>
