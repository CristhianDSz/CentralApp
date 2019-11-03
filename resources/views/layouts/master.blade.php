 
<!DOCTYPE html>
<html>
    
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Central App - Vicente Azuero</title>

        <meta charset="UTF-8">
        <meta name="description" content="Plataforma para apoyar los procesos de enseñanza aprendizaje en Colombia">
        <meta name="keywords" content="Ova, Docente, Aprendizaje, Plataforma web">
        <meta name="language" content="es-ES">
        <meta name="author" content="Cristhian Sánchez">
        {{-- <link href="https://fonts.googleapis.com/icon?family=Poppins" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    </head>
    <body>
        <!-- START NAV -->
    <nav class="navbar columns is-fixed-top" role="navigation" aria-label="main navigation" id="app-header">
    <div class="navbar-brand column is-2 is-paddingless">
        <a class="navbar-item" href="index.html">
            CENTRAL APP
        </a>
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="touchMenu">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    
    <div id="touchMenu">
    <a class="navbar-item is-active" href="{{ route('ovas.render') }}">
            <span class="icon">
                <i class="fa fa-home"></i>
            </span> Ovas
        </a>
        <a class="navbar-item is-active" href="https://nafplann.com/bulma-admin">
            <span class="icon">
                <i class="fa fa-home"></i>
            </span> Componentes
        </a>
        <a class="navbar-item is-active" href="https://nafplann.com/bulma-admin">
            <span class="icon">
                <i class="fa fa-home"></i>
            </span> Áreas
        </a>
        <a class="navbar-item is-active" href="https://nafplann.com/bulma-admin">
            <span class="icon">
                <i class="fa fa-home"></i>
            </span> Grados
        </a>
    </div>

    <div id="navMenu" class="navbar-menu column is-hidden-touch">
        <div class="navbar-end">
            <div class="navbar-item">
                <a class="button is-white" onclick="Auth.logout()">
                    <span class="icon">
                        <i class="fa fa-lg fa-bell"></i>
                    </span>
                </a>
            </div>
            <div class="navbar-item">
                <a class="button is-white" onclick="Auth.logout()">
                    <span class="icon">
                        <i class="fa fa-lg fa-power-off"></i>
                    </span>
                </a>
            </div>
            <div class="navbar-item has-dropdown">
                <a class="navbar-link">
                    <figure class="image avatar is-32x32">
                        <img class="is-rounded" src="images/user1.png">
                    </figure>
                    &nbsp; Hi, Cristhian
                </a>
                <div class="navbar-dropdown is-right">
                    <a class="navbar-item">
                        Overview
                    </a>
                    <a class="navbar-item">
                        Elements
                    </a>
                    <a class="navbar-item">
                        Components
                    </a>
                    <hr class="navbar-divider">
                    <div class="navbar-item">
                        Version 0.7.1
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>        <!-- END NAV -->

<div class="columns" id="app-content">
    <div class="column is-2 is-fullheight is-hidden-touch" id="navigation">
    <aside class="menu">
        <p class="menu-label is-hidden-touch">
            General
        </p>
        <ul class="menu-list">
            <li>
                <a class="" href="/">
                    <span class="icon">
                        <i class="fa fa-home"></i>
                    </span> Tablero
                </a>
            </li>
            <li>
            <a class="{{ Route::currentRouteName() == 'ovas.render' ? 'is-active' : ''}}" href="{{ route('ovas.render') }}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span> Ovas
                </a>
            </li>
            <li>
            <a class="{{ Route::currentRouteName() == 'components.render' ? 'is-active' : ''}}" href="{{ route('components.render') }}">
                    <span class="icon">
                        <i class="fa fa-codepen"></i>
                    </span> Componentes
                </a>
            </li>
            <li>
            <a class="{{ Route::currentRouteName() == 'mandatory-areas.render' ? 'is-active' : ''}}" href="{{ route('mandatory-areas.render') }}">
                    <span class="icon">
                        <i class="fa fa-leanpub"></i>
                    </span>Áreas
                </a>
            </li>
            <li>
            <a class="{{ Route::currentRouteName() == 'grades.render' ? 'is-active' : ''}}" href="{{ route('grades.render') }}">
                    <span class="icon">
                        <i class="fa fa-users"></i>
                    </span>Grados
                </a>
            </li>
            <li>
                <a class="" href="datatables.html">
                    <span class="icon">
                        <i class="fa fa-user"></i>
                    </span>Usuarios
                </a>
            </li>
            <li>
                <a class="" href="datatables.html">
                    <span class="icon">
                        <i class="fa fa-smile-o"></i>
                    </span>Usuario grado
                </a>
            </li>
            <li>
            <a class="{{ Route::currentRouteName() == 'schools.index' ? 'is-active' : ''}}" href="{{route('schools.index') }}">
                    <span class="icon">
                        <i class="fa fa-building"></i>
                    </span>Institución
                </a>
            </li>
        </ul>
    </aside>
</div>

<div class="column is-10" id="page-content">
    <div class="content-header">
        <h4 class="title is-4">@yield('header-title')</h4>
        <span class="separator"></span>
        <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
            <ul>
                <li><a href="#">General</a></li>
                <li class="is-active"><a href="#" aria-current="page">@yield('subheader-title')</a></li>
            </ul>
        </nav>
    </div>

    <div class="content-body" id="app">
        @yield('content')
    </div>

    </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>