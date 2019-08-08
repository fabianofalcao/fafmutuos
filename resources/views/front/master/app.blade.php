<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>{{$title ?? 'Mutuos'}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <!--Style-->
    <link href="{{url('assets/front/css/style.css')}}" rel="stylesheet">

    <!--Responsive-->
    <link rel="stylesheet" href="{{url('assets/front/css/responsive.css')}}">

    <!--Resets-->
    <link href="{{url('assets/front/css/reset.css')}}" rel="stylesheet">

    <!--Fonts Google-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!--Icons-->
    <script src="https://kit.fontawesome.com/4849e58e1e.js"></script>

    <!--Favicon-->
    <link rel="icon" href="images/favicon.png" type="image/png">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light menu">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="?pg=home">
            <img src="images/logo.png" alt="" class="img-menu">
        </a>
        <div class="collapse navbar-collapse">
            <ul class="menu">
                <li class="nav-item">
                    <a class="nav-link" href="?pg=home">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?pg=promocoes">QUEM SOMOS?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?pg=promocoes">COMO FUNCIONA?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?pg=promocoes">CONTATO</a>
                </li>
            </ul>
        </div><!--collapse-->
        <div class="main-auth">
            <a href="{{route('login')}}" class="sign">ENTRAR</a>
            <a href="{{route('register')}}" class="signup efect-transition">CADASTRE-SE</a>
        </div>
        <!--
        <div class="main-user-auth">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle user-auth" id="dropdownMenuButton" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <img src="images/no-image.png" alt="" class="img-header-user">
                    Nome Usuário
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="?pg=meu-perfil">Meu Perfil</a>
                    <a class="dropdown-item" href="?pg=compras">Minhas Compras</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="">Sair</a>
                </div>
            </div>
        </div><!-- main-user-auth -->
        -->
    </div><!--Container-->
</nav><!--Menu-->

    @yield('content')

<div class="footer-copy">
    <div class="container">
        <p>Copyright Mutuos Ltda - Todos os direitos reservados</p>
    </div>
</div><!--Footer Copy-->


<!--JS-->

<!--jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- JQuery-mask -->
<script src="{{url('assets/front/js/jquery.mask.js')}}"></script>

<!--Bootstrap-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>

<script src="{{url('assets/front/js/scripts.js')}}"></script>

</body>
</html>
