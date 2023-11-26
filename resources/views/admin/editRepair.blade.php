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
            <span class="card-title">{{!empty($repair['id'])?$repair['name']:'Reparación'}}</span>
            
            <div class="row" id="basic"> 
                <div class="col s4 input-field">
                    <input type="text" id="name" value="{{!empty($repair['name'])?$repair['name']:''}}">
                    <label for="name">Nombre</label>
                </div>
                <div class="col s4 input-field">
                    <input type="date" id="fecha_entrega" value="{{!empty($repair['fecha_entrega'])?$repair['fecha_entrega']:''}}">
                    <label for="fecha_entrega">Fecha de entrega</label>
                </div>
                <div class="col s4 input-field">
                    <input type="date" id="fecha_recogida" value="{{!empty($repair['fecha_recogida'])?$repair['fecha_recogida']:''}}">
                    <label for="fecha_recogida">Fecha recogida</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="precio" value="{{!empty($repair['precio'])?$repair['precio']:''}}">
                    <label for="precio">Precio</label>
                </div>
                <div class="col s4 input-field">
                    <select id="client">
                        @if(!empty($clients))
                            @foreach($clients as $_client)
                                <option value="{{$_client->id}}" {{!empty($product) && $_client->id == $client['id'] ? 'selected' : ''}}>{{$_client->name}}</option>
                            @endforeach
                        @endif
                    </select>     
                    <label for="client">client</label> 
                </div>
                <div class="col s4 input-field">
                    <select id="status">
                        <option value="1" {{!empty($rent['status']) && $rent['status'] == 1 ? 'selected' : ''}}>Recogido</option>
                        <option value="2" {{!empty($rent['status']) && $rent['status'] == 2 ? 'selected' : ''}}>En reparación</option>
                        <option value="3" {{!empty($rent['status']) && $rent['status'] == 3 ? 'selected' : ''}}>Reparado</option>
                        <option value="4" {{!empty($rent['status']) && $rent['status'] == 4 ? 'selected' : ''}}>Entregado</option>
                    </select>     
                    <label for="client">client</label> 
                </div>
                <div class="col s12 padding">
                    <a href="javascript:;" class="btn" id="saveRepair">Guardar</a>
                </div>
            </div>
        </div>
    </div>
    <input type="text" id="id" value="{{$repair['id'] ?? 0}}" hidden>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#saveRepair').click(function(){
                var id = $('#id').val();
                var name = $('#name').val();
                var fecha_entrega = $('#fecha_entrega').val();
                var fecha_recogida = $('#fecha_recogida').val();
                var precio = $('#precio').val();
                var client = $('#client').val();
                var status = $('#status').val();
                var data = {
                    id: id,
                    name: name,
                    fecha_entrega: fecha_entrega,
                    fecha_recogida: fecha_recogida,
                    id_cliente: client,
                    precio: precio,
                    status: status,
                    _token: '{{csrf_token()}}'
                };
                $.ajax({
                    url: '/repairSave',
                    type: 'POST',
                    data: data,
                    success: function(response){
                        if(response.success){
                            M.toast({html: response.message});
                            window.location.href = '/repairEdit/'+response.id;
                        }else{
                            M.toast({html: response.message});
                        }
                    }
                });
            });
        });     
    </script>
@endsection