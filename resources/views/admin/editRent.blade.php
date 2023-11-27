@extends('admin.layout')

@section('title')
    <title>Panel BigFootSki</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>

        .h1 {
            text-align: center;
            font-size: 15px;
        }

        #video-container {
            width: 100%;
            max-width: 300px;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
        }

        #qr-video {
            width: 100%;
            height: auto;
            display: block;
        }

        #controls {
            position: absolute;
            right: 0px;
            width: 20%;
            display: block;
            justify-content: space-between;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.2);
            height: 100%;
            z-index: 99999;
            display: none;
        }

        button {
            padding: 8px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #cam-qr-result {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
            box-sizing: border-box;
        }

        svg{
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="row card">
        <div class="col s12 card-content">
            <span class="card-title">{{!empty($rent['id'])?$rent['date'].' '.$rent['time_start'].' - '.$rent['time_end']:'Alquiler de Producto'}}</span>
            
            <div class="row" id="basic">
                <div class="col s4 input-field">
                    <select id="client" multiple>
                        @if(!empty($clients))
                            @php
                                $rent['clients'] = !empty($rent['clients'])?explode(',',$rent['clients']):[];
                            @endphp
                            @foreach($clients as $_client)
                                <option value="{{$_client->id}}" {{!empty($rent['clients']) && in_array($_client->id,$rent['clients']) ? 'selected' : ''}}>{{$_client->name}}</option>
                            @endforeach
                        @endif
                    </select>     
                    <label for="client">client</label> 
                </div>
                <div class="col s4 input-field">
                    <select id="status">
                        <option value="1" {{!empty($rent['status']) && $rent['status'] == 1 ? 'selected' : ''}}>Activo</option>
                        <option value="0" {{!empty($rent['status']) && $rent['status'] == 0 ? 'selected' : ''}}>Inactivo</option>
                    </select>     
                    <label for="status">Estado</label> 
                </div>
                <div class="col s3 input-field">
                    <input type="date" id="date" value="{{!empty($rent['date'])?$rent['date']:date('Y-m-d')}}">
                    <label for="date">Fecha</label>
                </div>
                <div class="col s3 input-field">
                    <input type="time" id="time_start" value="{{!empty($rent['time_start'])?$rent['time_start']:date('H:i')}}">
                    <label for="time_start">Hora Inicio</label>
                </div>
                <div class="col s3 input-field">
                    <input type="time" id="time_end" value="{{!empty($rent['time_end'])?$rent['time_end']:date('H:i')}}">
                    <label for="time_end">Hora Fin</label>
                </div>
                <div class="col s3 input-field">
                    <input type="text" id="price" value="{{!empty($rent['price'])?$rent['price']:''}}">
                    <label for="price">precio</label>
                </div>
                
            </div>

            <div class="row" id="productos">

            </div>
            <div class="row">
                <div class="col s12">
                    <h4>Total: <b id="total"></b></h4>
                </div>
            </div>

            <div class="row">
                <div class="col s12 padding">
                    <a href="javascript:;" class="btn" id="saveRent">Guardar</a>
                    <a class="waves-effect waves-light btn modal-trigger" href="#qr">QR</a>
                </div>
            </div>
        </div>
    </div>
    <input type="text" id="id" value="{{$rent['id'] ?? 0}}" hidden>
    <div class="modal" id="qr">
        <div class="modal-content">
            <h1 class="h1">QR Scanner</h1>
            <div class="row">
                <div class="col s2 offset-s5">
                    {{$qr}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="module">
        import QrScanner from "/qr/qr-scanner.min.js";

        const video = document.getElementById('qr-video');
        const videoContainer = document.getElementById('video-container');
        const camHasCamera = document.getElementById('cam-has-camera');
        const camList = document.getElementById('cam-list');
        const camHasFlash = document.getElementById('cam-has-flash');
        const flashToggle = document.getElementById('flash-toggle');
        const flashState = document.getElementById('flash-state');
        const camQrResult = document.getElementById('cam-qr-result');
        const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');
        const fileSelector = document.getElementById('file-selector');
        const fileQrResult = document.getElementById('file-qr-result');

        function setResult(label, result) {
            console.log(result.data);
            label.textContent = result.data;
            camQrResultTimestamp.textContent = new Date().toString();
            label.style.color = 'teal';
            clearTimeout(label.highlightTimeout);
            label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
        }

        // ####### Web Cam Scanning #######

        const scanner = new QrScanner(video, result => setResult(camQrResult, result), {
            onDecodeError: error => {
                camQrResult.textContent = error;
                camQrResult.style.color = 'inherit';
            },
            highlightScanRegion: true,
            highlightCodeOutline: true,
        });

        const updateFlashAvailability = () => {
            scanner.hasFlash().then(hasFlash => {
                camHasFlash.textContent = hasFlash;
                flashToggle.style.display = hasFlash ? 'inline-block' : 'none';
            });
        };

        scanner.start().then(() => {
            updateFlashAvailability();
            // List cameras after the scanner started to avoid listCamera's stream and the scanner's stream being requested
            // at the same time which can result in listCamera's unconstrained stream also being offered to the scanner.
            // Note that we can also start the scanner after listCameras, we just have it this way around in the demo to
            // start the scanner earlier.
            QrScanner.listCameras(true).then(cameras => cameras.forEach(camera => {
                const option = document.createElement('option');
                option.value = camera.id;
                option.text = camera.label;
                camList.add(option);
            }));
        });

        QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);

        // for debugging
        window.scanner = scanner;

        camList.addEventListener('change', event => {
            scanner.setCamera(event.target.value).then(updateFlashAvailability);
        });

        flashToggle.addEventListener('click', () => {
            scanner.toggleFlash().then(() => flashState.textContent = scanner.isFlashOn() ? 'on' : 'off');
        });

        document.getElementById('start-button').addEventListener('click', () => {
            scanner.start();
        });

        document.getElementById('stop-button').addEventListener('click', () => {
            scanner.stop();
        });

        // ####### File Scanning #######

        fileSelector.addEventListener('change', event => {
            const file = fileSelector.files[0];
            if (!file) {
                return;
            }
            QrScanner.scanImage(file, { returnDetailedScanResult: true })
                .then(result => setResult(fileQrResult, result))
                .catch(e => setResult(fileQrResult, { data: e || 'No QR code found.' }));
        });
    </script>
    <script>
        $(document).ready(function(){
            var total = 0;
            var last = {};
            if($('#id').val() != 0){
                setInterval(() => {
                    //llamamos a https://erp.nomadspro.com/bigfootski/get/ y obtenemos los productos usanbdo
                    $.ajax({
                        url: "/syncRent/"+$('#id').val(),
                        type: 'GET',
                        success: function(data){
                            
                            if(last != data){
                                var alredy = [];
                                var diff = [];
                                $.each(last,function(k,v){
                                    if(v != null){
                                        alredy.push(v.id);
                                        if(v.id == 0){
                                            diff.push(v);
                                        }
                                    }
                                });
                                $.each(data,function(k,v){
                                    if(v != null){
                                        if(!alredy.includes(v.id)){
                                            diff.push(v);
                                        }
                                    }
                                });
                                last = data;
                                $.each(diff,function(k,v){
                                    if(v!=null){
                                    hmtl = `<div class="col s12 m6 l4">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col s12 center-align">
                                                    <span class="card-title">`+v.name+`</span>
                                                </div>    
                                                <div class="col s6 center-align">
                                                    <p>`+v.quality+`</p>
                                                    <p>`+v.size+`</p>
                                                    <p>`+v.health+`</p>
                                                </div>
                                                <div class="col s6 center-align">
                                                    <input type="date" data-id="`+v.id+`" class="date_start" id="date_start`+v.id+`" value="">
                                                    <input type="date" data-id="`+v.id+`" class="date_end" id="date_end`+v.id+`" value="">
                                                    <input type="text" id="price`+v.id+`" value='`+v.precio+`' hidden>
                                                </div>
                                                <div class="col s12 center-align">
                                                    <b class="subtotal" id="total`+v.id+`"></b>€
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-action">
                                            <a href="javascript:;" class="btn" onclick="deleteProduct(`+v.id+`)">Eliminar</a>
                                        </div>
                                    </div>
                                    </div>`;
                                    $('#productos').append(hmtl);
                                    }
                                })
                                $('.date_end').change(function(){
                                    var id = $(this).data('id');
                                    var date_start = $('#date_start'+id).val();
                                    var date_end = $('#date_end'+id).val();
                                    var price = $('#price'+id).val();
                                    console.log(price)
                                    prices_data = JSON.parse(price);
                                    console.log(prices_data)
                                    var days = Math.floor(( Date.parse(date_end) - Date.parse(date_start) ) / 86400000);
                                    var price = prices_data[days] ?? 'NaN';
                                    console.log(price)
                                    $('#total'+id).html(price);
                                    total = 0;
                                    $('.subtotal').each(function(){
                                        total += parseFloat($(this).html());
                                    });
                                    $('#total').html(total+'€');
                                });

                            }
                        }
                    });
                }, 1000);
            }
            $('select').formSelect();
            $('.modal').modal();
            $('#saveRent').click(function(){
                var id = $('#id').val();
                var product = $('#product').val();
                var client = $('#client').val();
                var status = $('#status').val();
                var date = $('#date').val();
                var time_start = $('#time_start').val();
                var time_end = $('#time_end').val();
                var price = $('#price').val();
                $.ajax({
                    url: "/rentSave",
                    type: 'POST',
                    data: {
                        id: id,
                        product_id: product,
                        client_id: client,
                        status: status,
                        date: date,
                        time_start: time_start,
                        time_end: time_end,
                        price: price,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(data){
                        if(data.success){
                            M.toast({html: response.message});
                            window.location.href = "/rents";
                        }else{
                            alert(data.message);
                        }
                    }
                });
            });
            $('#generateQR').click(function(){
                var id = $('#id').val();
                var product = $('#product').val();
                var client = $('#client').val();
                var status = $('#status').val();
                var date = $('#date').val();
                var time_start = $('#time_start').val();
                var time_end = $('#time_end').val();
                var price = $('#price').val();
                $.ajax({
                    url: "/rentSave",
                    type: 'POST',
                    data: {
                        id: id,
                        product_id: product,
                        client_id: client,
                        status: status,
                        date: date,
                        time_start: time_start,
                        time_end: time_end,
                        price: price,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(data){
                        if(data.success){
                            M.toast({html: response.message});
                            window.location.href = "/rents";
                        }else{
                            alert(data.message);
                        }
                    }
                });
                /*$.ajax({
                    url: "/generateQR",
                    type: 'POST',
                    data: {
                        id: id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(data){
                        if(data.success){
                            M.toast({html: response.message});
                            window.location.href = "/rents";
                        }else{
                            alert(data.message);
                        }
                    }
                });*/
                
            })
        });     
    </script>
@endsection