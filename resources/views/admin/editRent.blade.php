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
            <span class="card-title">{{!empty($rent['id'])?$rent['date'].' '.$rent['time_start'].' - '.$rent['time_end'].' ('.$product->name.' '.$client->name.')':'Alquiler de Producto'}}</span>
            
            <div class="row" id="basic">
                <div class="col s4 input-field">
                    <select id="product">
                        @if(!empty($products))
                            @foreach($products as $_product)
                                <option value="{{$_product->id}}" {{!empty($product) && $_product->id == $product['id'] ? 'selected' : ''}}>{{$_product->name}}</option>
                            @endforeach
                        @endif
                    </select>     
                    <label for="product">Producto</label> 
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
                        <option value="1" {{!empty($rent['status']) && $rent['status'] == 1 ? 'selected' : ''}}>Activo</option>
                        <option value="0" {{!empty($rent['status']) && $rent['status'] == 0 ? 'selected' : ''}}>Inactivo</option>
                    </select>     
                    <label for="status">Estado</label> 
                </div>
                <div class="col s3 input-field">
                    <input type="date" id="date" value="{{!empty($rent['date'])?$rent['date']:date('Y-m-d')}}">
                    <label for="date">Fecha</label>
                </div>
                <div class="col s3 input-field">
                    <input type="time" id="time_start" value="{{!empty($rent['time_start'])?$rent['time_start']:date('H:i')}}">
                    <label for="time_start">Hora Inicio</label>
                </div>
                <div class="col s3 input-field">
                    <input type="time" id="time_end" value="{{!empty($rent['time_end'])?$rent['time_end']:date('H:i')}}">
                    <label for="time_end">Hora Fin</label>
                </div>
                <div class="col s3 input-field">
                    <input type="number" id="price" value="{{!empty($rent['price'])?$rent['price']:''}}">
                    <label for="price">Precio</label>
                </div>
                <div class="col s12 padding">
                    <a href="javascript:;" class="btn" id="saveRent">Guardar</a>
                </div>
            </div>
        </div>
    </div>
    <input type="text" id="id" value="{{$rent['id'] ?? 0}}" hidden>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#saveRent').click(function(){
                var id = $('#id').val();
                var product = $('#product').val();
                var client = $('#client').val();
                var status = $('#status').val();
                var date = $('#date').val();
                var time_start = $('#time_start').val();
                var time_end = $('#time_end').val();
                var price = $('#price').val();
                $.ajax({
                    url: "/rentSave",
                    type: 'POST',
                    data: {
                        id: id,
                        product_id: product,
                        client_id: client,
                        status: status,
                        date: date,
                        time_start: time_start,
                        time_end: time_end,
                        price: price,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(data){
                        if(data.success){
                            M.toast({html: response.message});
                            window.location.href = "/rents";
                        }else{
                            alert(data.message);
                        }
                    }
                });
            });
        });     
    </script>
@endsection