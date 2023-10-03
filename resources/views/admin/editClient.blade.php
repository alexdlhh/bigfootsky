@extends('admin.layout')

@section('title')
    <title>Panel BigFootSki</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
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
        </div>
    </div>
    <input type="text" id="id" value="{{$client['id'] ?? 0}}" hidden>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
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
                var data = {
                    id: id,
                    name: name,
                    surname: surname,
                    dni: dni,
                    email: email,
                    phone: phone,
                    address: address,
                    birthdate: birthdate,
                    height: height,
                    weight: weight,
                    shoe_size: shoe_size,
                    ski_level: ski_level,
                    snow_level: snow_level,
                    snow_front: snow_front,
                    _token: '{{csrf_token()}}'
                };
                $.ajax({
                    url: '/clientSave',
                    type: 'POST',
                    data: data,
                    success: function(response){
                        if(response.success){
                            M.toast({html: response.message});
                            window.location.href = '/clientEdit/'+response.id;
                        }else{
                            M.toast({html: response.message});
                        }
                    }
                });
            });
        });     
    </script>
@endsection