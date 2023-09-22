<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('title')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('style')
</head>

@php
    $section = !empty($admin['section']) ? $admin['section'] : '';
@endphp

<body>
    <nav>
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo">BigFootSky</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    
    <ul class="sidenav" id="mobile-demo">
        <li><a href="/adminPanel">Dashboard</a></li>
        <li><a href="/products">Productos</a></li>
        <li><a href="/rents">Alquiler</a></li>
        <li><a href="/teachers">Profesores</a></li>
        <li><a href="/courses">Cursos</a></li>
        <li><a href="/particulars">Clases Particulares</a></li>
        <li><a href="/logout">Logout</a></li>
    </ul>

    <div class="row">
        <div class="col s12 l2 hide-on-med-and-down" id="columna">
            <ul class="collection">
                <li class="collection-item {{$section=='adminPanel'?'active':''}}"><a href="/adminPanel">Dashboard</a></li>
                <li class="collection-item {{$section=='products'?'active':''}}"><a href="/products">Productos</a></li>
                <li class="collection-item {{$section=='rents'?'active':''}}"><a href="/rents">Alquiler</a></li>
                <li class="collection-item {{$section=='teachers'?'active':''}}"><a href="/teachers">Profesores</a></li>
                <li class="collection-item {{$section=='courses'?'active':''}}"><a href="/courses">Cursos</a></li>
                <li class="collection-item {{$section=='particulars'?'active':''}}"><a href="/particulars">Clases Particulares</a></li>
                <li class="collection-item"><a href="/logout">Logout</a></li>
            </ul>
        </div>
        <div class="col s12 l10">
            @yield('content')
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    @yield('script')
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $('.materialboxed').materialbox();
            $('select').formSelect();
        });
    </script>
</body>
</html>