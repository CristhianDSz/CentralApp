 
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
        <meta name="description" content="Free Admin Dashboard Template Build with Bulma.io By nafplann">
        <meta name="keywords" content="Bulma,CSS,Admin,Template,Free,Download">
        <meta name="language" content="en-EN">
        <meta name="author" content="Abdul Manaaf">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css">
        <link href="https://fonts.googleapis.com/icon?family=Poppins" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
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
        <a class="navbar-item is-active" href="https://nafplann.com/bulma-admin">
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
                <a class="is-active" href="index.html">
                    <span class="icon">
                        <i class="fa fa-home"></i>
                    </span> Tablero
                </a>
            </li>
            <li>
                <a class="" href="forms.html">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span> Ovas
                </a>
            </li>
            <li>
                <a class="" href="elements.html">
                    <span class="icon">
                        <i class="fa fa-desktop"></i>
                    </span> Componentes
                </a>
            </li>
            <li>
            <a class="" href="{{ route('mandatory-areas.index') }}">
                    <span class="icon">
                        <i class="fa fa-table"></i>
                    </span>Áreas
                </a>
            </li>
            <li>
                <a class="" href="datatables.html">
                    <span class="icon">
                        <i class="fa fa-table"></i>
                    </span>Grados
                </a>
            </li>
            <li>
                <a class="" href="datatables.html">
                    <span class="icon">
                        <i class="fa fa-table"></i>
                    </span>Usuarios
                </a>
            </li>
            <li>
                <a class="" href="datatables.html">
                    <span class="icon">
                        <i class="fa fa-table"></i>
                    </span>Usuario grado
                </a>
            </li>
            <li>
                <a class="" href="datatables.html">
                    <span class="icon">
                        <i class="fa fa-table"></i>
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

    <div class="content-body">
        @yield('content')
    </div>

    </div>
    </div>
</body>
</html>