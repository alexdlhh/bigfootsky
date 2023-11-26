@extends('admin.layout')

@section('title')
    <title>Panel BigFootSki</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection

@section('content')
    <div class="row card">
        <div class="col s12 card-content">
            <span class="card-title">{{!empty($client['id'])?$client['name'].' '.$client['surname']:'Cliente'}}</span>
            
            <div class="row" id="basic">
                <div class="col s4 input-field">
                    <input type="text" id="name" value="{{!empty($client['name'])?$client['name']:''}}">
                    <label for="name">Nombre</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="surname" value="{{!empty($client['surname'])?$client['surname']:''}}">
                    <label for="surname">Apellidos</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="dni" value="{{!empty($client['dni'])?$client['dni']:''}}">
                    <label for="dni">DNI</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="email" value="{{!empty($client['email'])?$client['email']:''}}">
                    <label for="email">Email</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="phone" value="{{!empty($client['phone'])?$client['phone']:''}}">
                    <label for="phone">Teléfono</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="address" value="{{!empty($client['address'])?$client['address']:''}}">
                    <label for="address">Dirección</label>
                </div>
                <div class="col s4 input-field">
                    <input type="date" id="birthdate" value="{{!empty($client['birthdate'])?$client['birthdate']:date('Y-m-d')}}">
                    <label for="birthdate">Fecha Nacimiento</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="height" value="{{!empty($client['height'])?$client['height']:''}}">
                    <label for="height">Altura</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="weight" value="{{!empty($client['weight'])?$client['weight']:''}}">
                    <label for="weight">Peso</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="shoe_size" value="{{!empty($client['shoe_size'])?$client['shoe_size']:''}}">
                    <label for="shoe_size">Talla de Calzado</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="ski_level" value="{{!empty($client['ski_level'])?$client['ski_level']:''}}">
                    <label for="ski_level">nivel de SKI</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="snow_level" value="{{!empty($client['snow_level'])?$client['snow_level']:''}}">
                    <label for="snow_level">nivel de SNOW</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="snow_front" value="{{!empty($client['snow_front'])?$client['snow_front']:''}}">
                    <label for="snow_front">Diestro/Zurdo SNOW</label>
                </div>
                <div class="col s12 padding">
                    <a href="javascript:;" class="btn" id="saveClient">Guardar</a>
                </div>
            </div>
            <div class="file-field input-field col s3">
                <div class="col s6 input-field">
                    <label for="image_a"></label>
                    <input type="file" id="image_a" name="image_a">
                </div>
                <div class="btn">
                    <span>DNI CARA A</span>
                    <input type="file" id="cara_a" name="cara_a">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="file-field input-field col s3">
                <div class="col s6 input-field">
                    <label for="image_b"></label>
                    <input type="file" id="image_b" name="image_b">
                </div>
                <div class="btn">
                    <span>DNI CARA B</span>
                    <input type="file" id="cara_b" name="cara_b">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="col s12 firma visitante_1">
                <div id="signature-pad" class="signature-pad">
                    <canvas id="signature"></canvas>
                    <button id="clear-button"><i class="material-icons">clear</i></button>
                </div>
            </div>
            <div class="col s12 center-align">
                <button class="btn waves-effect waves-light" id="registrar">Aceptar y contnuar</button>
            </div>		
        </div>  
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
    $(document).ready(function(){

        var canvas = $('#signature')[0];
        var signaturePad = new SignaturePad(canvas);
        var clearButton = $('#clear-button');
    
        clearButton.click(function() {
        signaturePad.clear();
        });

        $('#saveClient').click(function(){
            var id = $('#id').val();
            var name = $('#name').val();
            var surname = $('#surname').val();
            var dni = $('#dni').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var address = $('#address').val();
            var birthdate = $('#birthdate').val();
            var height = $('#height').val();
            var weight = $('#weight').val();
            var shoe_size = $('#shoe_size').val();
            var ski_level = $('#ski_level').val();
            var snow_level = $('#snow_level').val();
            var snow_front = $('#snow_front').val();
            // Crear un objeto FormData para enviar los datos
            var formData = new FormData();
            formData.append('id', id);
            formData.append('name', name);
            formData.append('surname', surname);
            formData.append('dni', dni);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('address', address);
            formData.append('birthdate', birthdate);
            formData.append('height', height);
            formData.append('weight', weight);
            formData.append('shoe_size', shoe_size);
            formData.append('ski_level', ski_level);
            formData.append('snow_level', snow_level);
            formData.append('snow_front', snow_front);

            // Agregar las imágenes "cara A" y "cara B al formulario
            formData.append('caraa', $('#caraa')[0].files[0]);
            formData.append('carab', $('#carab')[0].files[0]);

            formData.append('_token', '{{ csrf_token() }}');

            // Realizar la solicitud AJAX para enviar los datos y las imágenes
            $.ajax({
                url: '/clientSave',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response.success){
                        M.toast({html: response.message});
                        window.location.href = '/clientEdit/' + response.id;
                    } else {
                        M.toast({html: response.message});
                    }
                }
            });
        });
    });     
    </script>
    
    <style>
        .signature-pad {
            position: relative;
            width: 400px;
            height: 200px;
            border: 1px solid #000;
            margin: 0 auto;
        }
        .signature-pad canvas {
            width: 100%;
            height: 100%;
        }
        .firma {
            text-align: center;
        }
        .signature-pad button {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }
        a, li, button, p, span, label, .regular {
            font-family: 'TCCC-UnityHeadline-Regular' !important;
        }
    </style>
@endsection