<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ONEMI - @yield('title')</title>

    @include('layouts.styles')
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Branding Image -->
                <img src="{{ asset('images/onemi_logo.jpg') }}" class="nav-brand">
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse" style="padding-left: 10em">
                <!-- Left Side Of Navbar -->
                <a href="/home" class="btn navbar-btn @if($pagina == 'inicio')active @endif" role="button">Inicio</a>
                <a href="/catastrofes" class="btn navbar-btn @if($pagina == 'catastrofes')active @endif" role="button">Catástrofes</a>
                <a href="/medidas" class="btn navbar-btn @if($pagina == 'medidas')active @endif" role="button">Medidas</a>
                @role('admin', 'gob')
                <a href="/usuarios" class="btn navbar-btn @if($pagina == 'usuarios')active @endif" role="button">Usuarios</a>
                @endrole
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-right">
                    <!-- Authentication Links -->
                    <li class="dropdown">
                        <a href="#" class="navbar-btn dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->nombre }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"
                                    class="btn navbar-btn">
                                    Cerrar sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    @include('layouts.scripts')
</body>
</html>
