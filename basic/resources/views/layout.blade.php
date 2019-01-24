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
    <?php
        function active($url){
            return request()->is($url) ? 'active' : '';
        }
    ?>
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <a class="navbar-brand" href="{{route('index')}}">Inicio</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    {{--<li class="nav-item active">--}}
                        {{--<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="{{route('index')}}">Inicio</a>--}}
                    {{--</li>--}}
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
                        <li class="nav-item {{active('usuarios*')}}">
                            <a class="nav-link" href="{{route('usuarios.index')}}">Usuarios</a>
                        </li>
                        <li class="nav-item {{active('roles*')}}">
                            <a class="nav-link" href="{{route('roles.index')}}">Roles</a>
                        </li>
                    @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{auth()->user()->name}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <form style="display: inline;" action="{{route('logout')}}" method="post">
                                    @csrf
                                    <input style="color: darkgreen" class="btn btn-link" type="submit" value="Salir">
                                </form>
                                <a class="dropdown-item" href="{{route('usuarios.edit',auth()->user()->id)}}">Mi Perfil</a>
                            </div>
                        </li>

                    @else
                        <li class="nav-item {{active('login')}}">
                            <a class="nav-link" href="{{route('login')}}">Ingresar</a>
                        </li>
                        <li class="nav-item {{active('register')}}">
                            <a class="nav-link" href="{{route('register')}}">Registrarse</a>
                        </li>

                        {{--<a class="{{active('register')}}" href="{{route('register.show')}}">Registrarse</a>--}}
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
</body>
</html>
