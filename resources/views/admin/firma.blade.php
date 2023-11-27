@extends('layout')

@section('title')
    <title>Panel BigFootSki</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
    <div class="row card">
        <div class="col s12 card-content">
            <span class="card-title">Filtar</span>
            <div class="row">
                <div class="col l4 s12">
                    <div class="row">
                        <div class="col s12">
                            <iframe src="/avisolegal.pdf" width="100%" height="600px" frameborder="0"></iframe>
                        </div>
                        <div class="col s12">
                            <p>
                                <label>
                                    <input type="checkbox" />
                                    <span>He leido y consiento los avisos legales</span>
                                </label>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col l4 s12">
                    <div class="row">
                        <div class="col s12">
                            <iframe src="/datospersonales.pdf" width="100%" height="600px" frameborder="0"></iframe>
                        </div>
                        <div class="col s12">
                            <p>
                                <label>
                                    <input type="checkbox" />
                                    <span>He leido y doy consentimiento al archivado de mis datos personales</span>
                                </label>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col l4 s12">
                    <div class="row">
                        <div class="col s12">
                            <iframe src="/protecciondatos.pdf" width="100%" height="600px" frameborder="0"></iframe>
                        </div>
                        <div class="col s12">
                            <p>
                                <label>
                                    <input type="checkbox" />
                                    <span>He leido y acepto la protección de datos (se generará un documento con sus datos)</span>
                                </label>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col s12 firma visitante_1 center-align">
                    <div id="signature-pad" class="signature-pad">
                        <canvas id="signature" style="border:1px solid black"></canvas>
                        <button id="clear-button"><i class="material-icons">clear</i></button>
                    </div>
                </div>
                <div class="col s12 center-align">
                    <button class="btn waves-effect waves-light" id="registrar">Aceptar y contnuar</button>
                </div>
            </div>
        </div>
    </div> 
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        var canvas = $('#signature')[0];
        var signaturePad = new SignaturePad(canvas);
        var clearButton = $('#clear-button');
    
        clearButton.click(function() {
        signaturePad.clear();
        });   
    </script>
@endsection