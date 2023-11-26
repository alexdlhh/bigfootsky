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
<body>
    <nav>
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo">BigFootSki</a>
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
        <li><a href="/colaborators">Colaboradores</a></li>
        <li><a href="/category">Categorias</a></li>
        <li><a href="/repair">Reparaciones</a></li>
        <li><a href="/logout">Logout</a></li>
    </ul>
    @yield('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    @yield('script')
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $('.materialboxed').materialbox();
        });
    </script>
</body>
</html>