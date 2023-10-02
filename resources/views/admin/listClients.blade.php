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
                    <input type="text" id="filter_fullname" value="{{!empty($fullname)?$fullname:''}}">
                    <label for="filter_fullname">Nombre o Apellido</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="filter_dni" value="{{!empty($dni)?$dni:''}}">
                    <label for="filter_dni">DNI</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="filter_email" value="{{!empty($email)?$email:''}}">
                    <label for="filter_email">Email</label>                    
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="filter_phone" value="{{!empty($phone)?$phone:''}}">
                    <label for="filter_phone">Teléfono</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row card">
        <div class="col s12 card-content">
            <span class="card-title">Clientes</span>
            <div class="row table">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($clients))
                            @foreach($clients as $row => $client)
                                <tr>
                                    <td>{{$client->surname}}, {{$client->name}}</td>
                                    <td>{{$client->email}}</td>
                                    <td>{{$client->phone}}</td>
                                    <td>
                                        <a href="/clientEdit/{{$client->id}}" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">edit</i></a>
                                        <a href="#" class="btn-floating btn-small waves-effect waves-light red deleteClient" data-id="{{$client->id}}"><i class="material-icons">delete</i></a>
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
            <a href="/clientEdit/0" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
        </div>
    </div>    
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.deleteClient').click(function(){
                if(confirm('¿Seguro que desea borrar este cliente? la acción NO será reversible')){
                    var id = $(this).data('id');
                    var token = '{{csrf_token()}}';
                    $.ajax({
                        url: '/clientDelete/',
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