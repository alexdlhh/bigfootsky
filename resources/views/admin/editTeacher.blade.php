@extends('admin.layout')

@section('title')
    <title>Panel BigFootSky</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
    <div class="row card">
        <div class="col s12 card-content">
            <span class="card-title">{{!empty($teacher['id'])?$teacher['name']:'Profesor'}}</span>
            
            <div class="row" id="basic">
                <div class="col s4 input-field">
                    <input type="text" id="name" value="{{!empty($teacher['name'])?$teacher['name']:''}}">
                    <label for="name">Nombre</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="dni" value="{{!empty($teacher['dni'])?$teacher['dni']:''}}">
                    <label for="dni">DNI</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="email" value="{{!empty($teacher['email'])?$teacher['email']:''}}">
                    <label for="email">Email</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="phone" value="{{!empty($teacher['phone'])?$teacher['phone']:''}}">
                    <label for="phone">Teléfono</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="langs" value="{{!empty($teacher['langs'])?$teacher['langs']:''}}">
                    <label for="langs">Idiomas (separados por ;)</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="type" value="{{!empty($teacher['type'])?$teacher['type']:''}}">
                    <label for="type">Interno/Externo</label>
                </div>
                <div class="col s12 padding">
                    <a href="javascript:;" class="btn" id="saveTeacher">Guardar</a>
                </div>
            </div>
        </div>
    </div>
    <input type="text" id="id" value="{{$teacher['id'] ?? 0}}" hidden>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#saveTeacher').click(function(){
                var id = $('#id').val();
                var name = $('#name').val();
                var surname = $('#surname').val();
                var dni = $('#dni').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var langs = $('#langs').val();
                var type = $('#type').val();
                var data = {
                    id: id,
                    name: name,
                    dni: dni,
                    email: email,
                    phone: phone,
                    langs: langs,
                    type: type,
                    _token: '{{csrf_token()}}'
                };
                $.ajax({
                    url: '/teacherSave',
                    type: 'POST',
                    data: data,
                    success: function(response){
                        if(response.status == 'ok'){
                            window.location.href = '/teacherEdit/'+response.id;
                        }
                    }
                });
            });
        });     
    </script>
@endsection