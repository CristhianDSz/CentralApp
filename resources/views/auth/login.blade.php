 
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
    <style>
        html,body {
        font-size: 14px;
        font-weight: 300;
        }
        .hero.is-success {
        background: #F2F6FA;
        }
        .hero .nav, .hero.is-success .nav {
        -webkit-box-shadow: none;
        box-shadow: none;
        }
        .box {
        margin-top: 5rem;
        }
        .avatar {
        margin-top: -70px;
        padding-bottom: 20px;
        }
        .avatar img {
        padding: 5px;
        background: #fff;
        border-radius: 50%;
        -webkit-box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
        box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
        }
        input {
        font-weight: 300;
        }
        p {
        font-weight: 700;
        }
        p.subtitle {
        padding-top: 1rem;
        }

        .login-hr{
        border-bottom: 1px solid black;
        }

        .has-text-black{
        color: black;
        }

        .field{
        padding-bottom: 10px;
        }

        .fa{
        margin-left: 5px; 
        }
    </style>
    </head>
    <body>

    <section class="hero is-success is-fullheight">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <div class="column is-4 is-offset-4">
                        <h3 class="title has-text-black">Iniciar Sesión en CentralApp</h3>
                        <hr class="login-hr">
                        <p class="subtitle has-text-black">Por favor inicia sesión para proceder.</p>
                        <div class="box">
                            <figure class="avatar">
                                <img src="https://api.adorable.io/avatars/128/abott@adorable.png">
                            </figure>
                        <form action="{{route('login')}}" method="POST">
                                @csrf
                                <div class="field">
                                    <div class="control">
                                        <input name="email" class="input is-large" type="email" placeholder="Correo" autofocus="">
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <input name="password" class="input is-large" type="password" placeholder="Contraseña">
                                    </div>
                                </div>
                                <button type="submit" class="button is-block is-info is-large is-fullwidth">Ingresar <i class="fa fa-sign-in" aria-hidden="true"></i></button>
                            </form>
                        </div>
                        {{-- <p class="has-text-grey">
                            <a href="../">Sign Up</a> &nbsp;·&nbsp;
                            <a href="../">Forgot Password</a> &nbsp;·&nbsp;
                            <a href="../">Need Help?</a>
                        </p> --}}
                    </div>
                </div>
            </div>
        </section>
  
    </body>
</html>