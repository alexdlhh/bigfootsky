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
            <span class="card-title">Filtar</span>
            <div class="row">
                <div class="col s12 input-field">
                    <input type="text" id="filter_name" value="{{!empty($name)?$name:''}}">
                    <label for="filter_name">Nombre</label>
                </div>
                <div class="col s4 input-field">
                    <select id="filter_teacher">
                        <option value="">Todos</option>
                        @if(!empty($teachers))
                            @foreach($teachers as $row => $teacher)
                                <option value="{{$teacher->id}}" {{!empty($teacher_id) && $teacher_id == $teacher->id?'selected':''}}>{{$teacher->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    <label for="filter_teacher">Profesor</label>
                </div>
                <div class="col s4 input-field">
                    <input type="date" id="filter_date" value="{{!empty($date)?$date:''}}">
                    <label for="filter_date">Fecha</label>                    
                </div>
                <div class="col s4 input-field">
                    <input type="time" id="filter_time" value="{{!empty($time)?$time:''}}">
                    <label for="filter_time">Hora</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row card">
        <div class="col s12 card-content">
            <span class="card-title">Cursos</span>
            <div class="row table">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Profesor</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($courses))
                            @foreach($courses as $row => $course)
                                <tr>
                                    <td>{{$course->name}}</td>
                                    <td>{{$course->date}}</td>
                                    <td>{{$course->time_start}} - {{$course->time_end}}</td>
                                    <td>{{$course->teacher->name}}</td>
                                    <td>
                                        <a href="/courseEdit/{{$course->id}}" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">edit</i></a>
                                        <a href="#" class="btn-floating btn-small waves-effect waves-light red deletecourse" data-id="{{$course->id}}"><i class="material-icons">delete</i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 right-align">
            <a href="/courseEdit/0" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
        </div>
    </div>    
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.deleteCourse').click(function(){
                if(confirm('¿Seguro que desea borrar este Profesor? la acción NO será reversible')){
                    var id = $(this).data('id');
                    var token = '{{csrf_token()}}';
                    $.ajax({
                        url: '/courseDelete/',
                        type: 'POST',
                        data: {
                            id: id,
                            _token: token
                        },
                        success: function(response){
                            if(response.success){
                                location.reload();
                            }else{
                                alert(response.message);
                            }
                        }
                    });
                }
            })

            $('#filter_fullname').change(function(){
                var filter_fullname = $(this).val();
                var filter_dni = $('#filter_dni').val();
                var filter_email = $('#filter_email').val();
                var filter_phone = $('#filter_phone').val();
                window.location.href = '/clients/'+filter_fullname+'/'+filter_dni+'/'+filter_email+'/'+filter_phone;
            });

            $('#filter_dni').change(function(){
                var filter_fullname = $('#filter_fullname').val();
                var filter_dni = $(this).val();
                var filter_email = $('#filter_email').val();
                var filter_phone = $('#filter_phone').val();
                window.location.href = '/clients/'+filter_fullname+'/'+filter_dni+'/'+filter_email+'/'+filter_phone;
            });

            $('#filter_email').change(function(){
                var filter_fullname = $('#filter_fullname').val();
                var filter_dni = $('#filter_dni').val();
                var filter_email = $(this).val();
                var filter_phone = $('#filter_phone').val();
                window.location.href = '/clients/'+filter_fullname+'/'+filter_dni+'/'+filter_email+'/'+filter_phone;
            });

            $('#filter_phone').change(function(){
                var filter_fullname = $('#filter_fullname').val();
                var filter_dni = $('#filter_dni').val();
                var filter_email = $('#filter_email').val();
                var filter_phone = $(this).val();
                window.location.href = '/clients/'+filter_fullname+'/'+filter_dni+'/'+filter_email+'/'+filter_phone;
            });
        });        
    </script>
@endsection