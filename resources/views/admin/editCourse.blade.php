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
            <span class="card-title">{{!empty($course['id'])?$course['name']:'Curso'}}</span>
            
            <div class="row" id="basic">
                <div class="col s4 input-field">
                    <input type="text" id="name" value="{{!empty($course['name'])?$course['name']:''}}">
                    <label for="name">Nombre</label>
                </div>
                <div class="col s4 input-field">
                    <select id="teacher">
                        <option value="">Todos</option>
                        @if(!empty($teachers))
                            @foreach($teachers as $row => $teacher)
                                <option value="{{$teacher->id}}" {{!empty($teacher_id) && $teacher_id == $teacher->id?'selected':''}}>{{$teacher->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    <label for="teacher">Profesor</label>
                </div>
                <div class="col s4 input-field">
                    <input type="date" id="date" value="{{!empty($course['date'])?$course['date']:''}}">
                    <label for="date">Fecha</label>
                </div>
                <div class="col s4 input-field">
                    <input type="time" id="time_start" value="{{!empty($course['time_start'])?$course['time_start']:''}}">
                    <label for="time_start">Hora de inicio</label>
                </div>
                <div class="col s4 input-field">
                    <input type="time" id="time_end" value="{{!empty($course['time_end'])?$course['time_end']:''}}">
                    <label for="time_end">Hora de final</label>
                </div>
                <div class="col s4 input-field">
                    <select id="status">
                        <option value="1">Creado</option>
                        <option value="2">Abierto</option>
                        <option value="3">Completo</option>
                        <option value="4">Finalizado</option>
                    </select>
                    <label for="status">Estado</label>
                </div>
                <div class="col s4 input-field">
                    <input type="number" id="max_students" value="{{!empty($course['max_students'])?$course['max_students']:''}}">
                    <label for="max_students">Número máximo de alumnos</label>
                </div>
                <div class="col s12">
                    <textarea id="description" cols="30" rows="10"></textarea>
                </div>
                <div class="col s12 padding">
                    <a href="javascript:;" class="btn" id="saveCourse">Guardar</a>
                </div>
            </div>
        </div>
    </div>
    <input type="text" id="id" value="{{$course['id'] ?? 0}}" hidden>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.0.0/tinymce.min.js"></script>
    <script>
        var textareas = ['#descripcion'];
        $.each(textareas,function(index,textarea){
            tinymce.init({
                selector: textarea,
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
            });
        });
        $(document).ready(function(){
            $('#saveCourse').click(function(){
                var id = $('#id').val();
                var name = $('#name').val();
                var teacher_id = $('#teacher').val();
                var date = $('#date').val();
                var time_start = $('#time_start').val();
                var time_end = $('#time_end').val();
                var status = $('#status').val();
                var max_students = $('#max_students').val();
                var description = tinymce.get('description').getContent();
                var data = {
                    id: id,
                    name: name,
                    teacher_id: teacher_id,
                    date: date,
                    time_start: time_start,
                    time_end: time_end,
                    status: status,
                    max_students: max_students,
                    description: description,
                    _token: '{{csrf_token()}}'
                };
                $.ajax({
                    url: '/courseSave',
                    type: 'POST',
                    data: data,
                    success: function(response){
                        if(response.status == 'ok'){
                            window.location.href = '/courseEdit/'+response.id;
                        }
                    }
                });
            });
        });     
    </script>
@endsection