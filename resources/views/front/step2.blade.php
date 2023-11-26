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
        <div class="col s12 center-align texto">
            <p>Añade los productos de cada usuario</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 right-align">
            <div class="row" id="productosUsuario">
                <div class="col l10" id="productos">
                     <div class="row">
                        <div class="col l3" id="producto">
                            <p>Nombre</p>
                            <p>Talla</p>
                            <p>Gama</p>
                            <p>Precio</p>
                        </div>
                     </div>
                </div>
                <div class="col l2">
                    <a class="waves-effect waves-light btn modal-trigger botton" href="#modal1">Añadir producto</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 right-align">
            <a class="btn" href="/reserva-thanks">Guardar</a>
        </div>
    </div>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <div class="input-field col s12">
                <select>
                    <option value="" disabled selected></option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
                <label class="selectorcategory">Selector de Categoria</label>
            </div>
            <div class="input-field col s12">
                <select>
                    <option value="" disabled selected></option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
                <label class="selectorproduct">Selector de Producto</label>
            </div>
            <div>
                <p class="indicadorfechas">Indíca durante cuánto tiempo quieres disponer de este producto</p>
            </div>
            <div class="col l4 s6 input-field">
                <input type="text" id="fecha_inicio" value="{{!empty($client['fecha_inicio'])?$client['fecha_inicio']:''}}">
                <label for="fecha_inicio">Fecha de Inicio</label>
            </div>
            <div class="col l4 s6 input-field">
                <input type="text" id="fecha_fin" value="{{!empty($client['fecha_fin'])?$client['fecha_fin']:''}}">
                <label for="fecha_fin">Fecha Fin</label>
            </div>
        </div>  
        <div class="modal-footer">
            <a href="javascript:;" class="modal-close waves-effect waves-green btn-flat">Aceptar</a>
        </div>  
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
    $(document).ready(function(){
        $('.modal').modal();
        $('select').formSelect();
    });
    </script>
</body>
</html>