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
            <span class="card-title">{{!empty($colaborators['id'])?$colaborators['name']:'Colaborador'}}</span>
            
            <div class="row" id="basic">
                <div class="col s4 input-field">
                    <input type="text" id="name" value="{{!empty($colaborators['name'])?$colaborators['name']:''}}">
                    <label for="name">Nombre</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="employee" value="{{!empty($colaborators['employee'])?$colaborators['employee']:''}}">
                    <label for="employee">Empleados</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="discount" value="{{!empty($colaborators['discount'])?$colaborators['discount']:''}}">
                    <label for="discount">Descuento</label>
                </div>
                <div class="col s12 padding">
                    <a href="javascript:;" class="btn" id="saveColaborators">Guardar</a>
                </div>
            </div>
        </div>
    </div>
    <input type="text" id="id" value="{{$colaborators['id'] ?? 0}}" hidden>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#saveColaborators').click(function(){
                var id = $('#id').val();
                var name = $('#name').val();
                var employee = $('#employee').val();
                var discount = $('#discount').val();
                var data = {
                    id: id,
                    name: name,
                    employee: employee,
                    discount: discount,
                    _token: '{{csrf_token()}}'
                };
                $.ajax({
                    url: '/colaboratorsSave',
                    type: 'POST',
                    data: data,
                    success: function(response){
                        if(response.success){
                            M.toast({html: response.message});
                            window.location.href = '/colaboratorsEdit/'+response.id;
                        }else{
                            M.toast({html: response.message});
                        }
                    }
                });
            });
        });     
    </script>
@endsection