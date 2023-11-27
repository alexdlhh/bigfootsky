<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/css/public.css" rel="stylesheet">
    <title>Factura</title>
</head>
<body>
    <div class="row">
        <div class="col l2 s12">
            <img src="/Logo-2.png" alt="Escuela BigFootSki" width="100" id="imagelogo">
        </div>
        <div class="col l10 s12 info-container">
            <div class="text-info textinfo">
                <p>Nombre y Apellidos:</p>
                <p>DNI/NIF:</p>
                <p>Teléfono:</p>
                <p>Dirección:</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col l12 s12">
            <table class="striped">
                <thead>
                    <tr>
                        <th>Fecha entrada</th>
                        <th>Fecha salida</th>
                        <th>Esquí</th>
                        <th>Snow</th>
                        <th>Botas</th>
                        <th>Bastones</th>
                        <th>Cascos</th>
                        <th>Gafas</th>
                        <th>Guantes</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>25-11-2023</td>
                        <td>26-11-2023 1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>2</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                        <td>0</td>
                        <td>100€</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row center-align" id="observacionestotal">
        <div class="col l6 s12">
            <p>Observaciones:</p>
        </div>
        <div class="col l6 s12">
            <p>Subtotal:</p>
            <p>IVA:</p>
            <p>Total:</p>
        </div>
    </div>
    <div>
        <div class="row">
            <div class="col l12 s12 textimportant">
                <p>IMPORTANTE: El material es responsabilidad del cliente, en caso de ROBO, PÉRDIDA o DETERIORO deberá abonar el importe del equipo establecido por establecimiento o el coste del arreglo que requiriese.
                    La empresa queda excenta de responsabilidad de las pertenencias que se queden en el establecimiento.
                </p>
            </div>
        </div>
    </div>
</body>
</html>