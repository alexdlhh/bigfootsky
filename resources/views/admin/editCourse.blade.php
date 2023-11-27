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
            <span class="card-title">{{!empty($course['id'])?$course['name']:'Curso'}}</span>
            
            <div class="row" id="basic">
                <div class="col s4 input-field">
                    <input type="text" id="name" value="{{!empty($course['name'])?$course['name']:''}}">
                    <label for="name">Nombre</label>
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
                    <select id="teacher">
                        @if(!empty($teachers))
                            @foreach($teachers as $row => $teacher)
                                <option value="{{$teacher->id}}" {{!empty($teacher_id) && $teacher_id == $teacher->id?'selected':''}}>{{$teacher->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    <label for="teacher">Profesor</label>
                </div>
                <div class="col s4 input-field">
                    <input type="number" id="max_students" value="{{!empty($course['max_students'])?$course['max_students']:''}}">
                    <label for="max_students">Número máximo de alumnos</label>
                </div>
                <div class="col s4">
                    <p>
                        <label>
                            <input type="checkbox" id="material" {{!empty($course['material'])?'checked':''}}>
                            <span>Red</span>
                        </label>
                    </p>
                </div>
                <div class="col s12">
                    <textarea id="description" cols="30" rows="10">{{!empty($course['description'])?$course['description']:''}}</textarea>
                </div>
                <div class="col s12">
                    <div class="row">
                        <div class="col s12">
                            Alumnos
                        </div>
                        <div class="col s12">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Producto</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($students))
                                        @foreach($students as $row => $student)
                                            <tr>
                                                <td>{{$student->name}}</td>
                                                <td>{{$students_products[$student->id]->name ?? '-'}}</td>
                                                <td>
                                                    <a href="javascript:;" data-id-couse="{{$course['id']}}" data-id-student="{{$student->id}}" class="btn-floating btn-small waves-effect waves-light red deleteBtn"><i class="material-icons">delete</i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                    </div>
                </div>
                <div class="col s12 padding">
                    <a href="javascript:;" class="btn" id="saveCourse">Guardar</a>
                    @if($course['id']!=0)
                        <a href="#addToCourseModal" class="btn modal-trigger" id="addToCourseBtn">Añadir Alumno</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <input type="text" id="id" value="{{$course['id'] ?? 0}}" hidden>
    <!-- Modal Structure -->
    <div id="addToCourseModal" class="modal">
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <h4>Añadir al curso</h4>
                </div>
                <div class="col s6">
                    <label for="id_student">Alumno</label>
                    <select id="id_student">
                        @if(!empty($clients))
                            @foreach($clients as $row => $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                @if(!empty($course->material) && $course->material==1)
                <div class="col s6">
                    <label for="product_course">Productos</label>
                    <select id="product_course">
                        @if(!empty($products))
                            @foreach($products as $row => $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                @endif
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
            <a href="#!" class="modal-close waves-effect waves-green btn-flat" id="addToCourse">Añadir</a>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.0.0/tinymce.min.js"></script>
    <script>
        var textareas = ['#description'];
        $.each(textareas,function(index,textarea){
            tinymce.init({
                selector: textarea,
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
            });
        });
        $(document).ready(function(){
            $('select').formSelect();
            $('.modal').modal();
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
                var material = $('#material').is(':checked')?1:0;
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
                    material: material,
                    _token: '{{csrf_token()}}'
                };
                $.ajax({
                    url: '/courseSave',
                    type: 'POST',
                    data: data,
                    success: function(response){
                        if(response.status){
                            M.toast({html: response.message});
                            window.location.href = '/courseEdit/'+response.id;
                        }else{
                            alert(response.message);
                        }
                    }
                });
            });
            $('#addToCourse').click(function(){
                var id_course = $('#id').val();
                var id_student = $('#id_student').val();
                var product_id = $('#product_course').val();
                var data = {
                    id_course: id_course,
                    id_student: id_student,
                    product: product_id,
                    _token: '{{csrf_token()}}'
                };
                $.ajax({
                    url: '/addToCourse',
                    type: 'POST',
                    data: data,
                    success: function(response){
                        if(response.status){
                            M.toast({html: response.message});
                            window.location.href = '/courseEdit/'+response.id;
                        }else{
                            alert(response.message);
                        }
                    }
                });
            });
            $('.deleteBtn').click(function(){
                var id_course = $(this).data('id-couse');
                var id_student = $(this).data('id-student');
                var data = {
                    id_course: id_course,
                    id_student: id_student,
                    _token: '{{csrf_token()}}'
                };
                $.ajax({
                    url: '/deleteFromCourse',
                    type: 'POST',
                    data: data,
                    success: function(response){
                        if(response.status){
                            M.toast({html: response.message});
                            window.location.href = '/courseEdit/'+response.id;
                        }else{
                            alert(response.message);
                        }
                    }
                });
            });
        });     
    </script>
@endsection