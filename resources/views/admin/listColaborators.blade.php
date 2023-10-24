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
                <div class="col s12 input-field">
                    <input type="text" id="filter_fullname" value="{{!empty($fullname)?$fullname:''}}">
                    <label for="filter_fullname">Nombre o Apellido</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row card">
        <div class="col s12 card-content">
            <span class="card-title">Colaboradores</span>
            <div class="row table">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Empleados</th>
                            <th>Descuento</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($colaborators))
                            @foreach($colaborators as $row => $colaborators)
                                <tr>
                                    <td>{{$colaborators->name}}</td>
                                    <td>{{$colaborators->employees}}</td>
                                    <td>{{$colaborators->discount}}%</td>
                                    <td>
                                        <a href="/colaboratorsEdit/{{$colaborators->id}}" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">edit</i></a>
                                        <a href="#" class="btn-floating btn-small waves-effect waves-light red deleteColaborators" data-id="{{$colaborators->id}}"><i class="material-icons">delete</i></a>
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
            <a href="/colaboratorsEdit/0" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
        </div>
    </div>    
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.deleteColaborators').click(function(){
                if(confirm('¿Seguro que desea borrar este colaborador? la acción NO será reversible')){
                    var id = $(this).data('id');
                    var token = '{{csrf_token()}}';
                    $.ajax({
                        url: '/colaboratorsDelete/',
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
                window.location.href = '/colaborators/'+filter_fullname;
            });
        });        
    </script>
@endsection