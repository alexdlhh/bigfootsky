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
            <span class="card-title">Filtar</span>
            <div class="row">
                <div class="col s3 input-field">
                    <input type="date" id="date_start" value="{{!empty($date_start)?$date_start:''}}">
                    <label for="date_start">Fecha Inicio</label>
                </div>
                <div class="col s3 input-field">
                    <input type="date" id="date_end" value="{{!empty($date_end)?$date_end:''}}">
                    <label for="date_end">Fecha Fin</label>
                </div>
                <div class="col s3 input-field">
                    <select id="client_filter">
                        <option value="0" {{$client==0?'selected':''}}>Todos</option>
                        @if(!empty($clients))
                            @foreach($clients as $_client)
                                <option value="{{$_client->id}}" {{$_client->id == $client ? 'selected' : ''}}>{{$_client->name}}</option>
                            @endforeach
                        @endif
                    </select>     
                    <label for="client_filter">Clientes</label>
                </div>
                <div class="col s3 input-field">
                    <select id="status_filter">
                        <option value="0" {{$status==0?'selected':''}}>Todos</option>
                        <option value="1" {{$status==1?'selected':''}}>Libre</option>
                        <option value="2" {{$status==2?'selected':''}}>Alquilado</option>
                        <option value="3" {{$status==3?'selected':''}}>Mantenimiento</option>
                    </select>
                    <label for="status_filter">Estado</label>            
                </div>
            </div>
        </div>
    </div>
    <div class="row card">
        <div class="col s12 card-content">
            <span class="card-title">Alquileres</span>
            <div class="row table">
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th>Precio</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($rents))
                            @foreach($rents as $row => $rent)
                                <tr>
                                    <td>{{$rent->date}}</td>
                                    <td>{{$rent->time_start}} - {{$rent->time_end}}</td>
                                    <td>{{$statuses[$rent->status]}}</td>
                                    <td>{{$rent->price}}</td>
                                    <td>
                                        <a href="/rentEdit/{{$rent->id}}" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">edit</i></a>
                                        <a href="#" class="btn-floating btn-small waves-effect waves-light red deleteRent" data-id="{{$rent->id}}"><i class="material-icons">delete</i></a>
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
            <a href="/rentEdit/0" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
        </div>
    </div>    
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.deleteRent').click(function(){
                if(confirm('¿Seguro que desea borrar este alquiler? la acción NO será reversible')){
                    var id = $(this).data('id');
                    var token = '{{csrf_token()}}';
                    $.ajax({
                        url: '/rentDelete/',
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

            $('#date_end').change(function(){
                var date_start = $('#date_start').val();
                var date_end = $('#date_end').val();
                var client = $('#client_filter').val();
                var status = $('#status_filter').val();
                location.href = '/rents/'+date_start+'/'+date_end+'/'+client+'/'+status;
            });

            $('#date_start').change(function(){
                var date_start = $('#date_start').val();
                var date_end = $('#date_end').val();
                var client = $('#client_filter').val();
                var status = $('#status_filter').val();
                location.href = '/rents/'+date_start+'/'+date_end+'/'+client+'/'+status;
            });

            $('#client_filter').change(function(){
                var date_start = $('#date_start').val();
                var date_end = $('#date_end').val();
                var client = $('#client_filter').val();
                var status = $('#status_filter').val();
                location.href = '/rents/'+date_start+'/'+date_end+'/'+client+'/'+status;
            });

            $('#status_filter').change(function(){
                var date_start = $('#date_start').val();
                var date_end = $('#date_end').val();
                var client = $('#client_filter').val();
                var status = $('#status_filter').val();
                location.href = '/rents/'+date_start+'/'+date_end+'/'+client+'/'+status;
            });
        });        
    </script>
@endsection