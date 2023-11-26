<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/css/public.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="row">
        <div class="col l4 s12">
            <label for="usuario">Usuario</label>
            <input type="number" id="usuario" value="{{!empty($client['usuario'])?$client['usuario']:''}}">
        </div>
        <div class="col l8 s12">
            <p class="descripcion">Indíca el número de usuarios y rellena los formularios para realizar una reserva.</p>
        </div>
    </div>
    <div class="row ">
        <div class="col l12 s12 card-panel botton-space">
            <div class="row cajaUsuario" id="basic">
                <div class="col l3 s6 input-field">
                    <input type="text" id="name" value="{{!empty($client['name'])?$client['name']:''}}">
                    <label for="name">Nombre</label>
                </div>
                <div class="col l3 s6 input-field">
                    <input type="text" id="surname" value="{{!empty($client['surname'])?$client['surname']:''}}">
                    <label for="surname">Apellidos</label>
                </div>
                <div class="col l3 s6 input-field">
                    <input type="text" id="dni" value="{{!empty($client['dni'])?$client['dni']:''}}">
                    <label for="dni">DNI</label>
                </div>
                <div class="col l3 s6 input-field">
                    <input type="text" id="email" value="{{!empty($client['email'])?$client['email']:''}}">
                    <label for="email">Email</label>
                </div>
                <div class="col l3 s6 input-field">
                    <input type="text" id="phone" value="{{!empty($client['phone'])?$client['phone']:''}}">
                    <label for="phone">Teléfono</label>
                </div>
                <div class="col l3 s6 input-field">
                    <input type="text" id="address" value="{{!empty($client['address'])?$client['address']:''}}">
                    <label for="address">Dirección</label>
                </div>
                <div class="col l3 s6 input-field">
                    <input type="date" id="birthdate" value="{{!empty($client['birthdate'])?$client['birthdate']:date('Y-m-d')}}">
                    <label for="birthdate">Fecha Nacimiento</label>
                </div>
                <div class="col l3 s6 input-field">
                    <input type="text" id="height" value="{{!empty($client['height'])?$client['height']:''}}">
                    <label for="height">Altura</label>
                </div>
                <div class="col l3 s6 input-field">
                    <input type="text" id="weight" value="{{!empty($client['weight'])?$client['weight']:''}}">
                    <label for="weight">Peso</label>
                </div>
                <div class="col l3 s6 input-field">
                    <input type="text" id="shoe_size" value="{{!empty($client['shoe_size'])?$client['shoe_size']:''}}">
                    <label for="shoe_size">Talla de Calzado</label>
                </div>
                <div class="col l3 s6 input-field">
                    <input type="text" id="ski_level" value="{{!empty($client['ski_level'])?$client['ski_level']:''}}">
                    <label for="ski_level">nivel de SKI</label>
                </div>
                <div class="col l3 s6 input-field">
                    <input type="text" id="snow_level" value="{{!empty($client['snow_level'])?$client['snow_level']:''}}">
                    <label for="snow_level">nivel de SNOW</label>
                </div>
                <div class="col l3 s6 input-field">
                    <input type="text" id="snow_front" value="{{!empty($client['snow_front'])?$client['snow_front']:''}}">
                    <label for="snow_front">Diestro/Zurdo SNOW</label>
                </div>
            </div>
            <div class="col s12 padding right-align">
                <a href="/reserva-step2" class="btn" id="saveClient">Guardar</a>
                <!--DE MOMENTO PONEMOS DIRECTAMENTE LA URL PORQUE SOLO ESTAS HACIENDO EL HTML, CUANDO HAGAMOS EL JQUERY HAREMOS QUE SEA JQUERY QUIEN REDIRIJA A STEP2 CUANDO GUARDE LOS DATOS-->
            </div>
        </div>
    </div>
    
    
    <input type="text" id="id" value="{{$client['id'] ?? 0}}" hidden>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $('.materialboxed').materialbox();
            $('select').formSelect();
        });
    </script>
</body>
</html>