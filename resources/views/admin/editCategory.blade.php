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
            <span class="card-title">{{!empty($category['id'])?$category['name']:'Categoría'}}</span>
            
            <div class="row" id="basic">
                <div class="col s4 input-field">
                    <input type="text" id="name" value="{{!empty($category['name'])?$category['name']:''}}">
                    <label for="name">Nombre</label>
                </div>
                <div class="col s12 padding">
                    <a href="javascript:;" class="btn" id="saveCategory">Guardar</a>
                </div>
            </div>
        </div>
    </div>
    <input type="text" id="id" value="{{$category['id'] ?? 0}}" hidden>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#saveCategory').click(function(){
                var id = $('#id').val();
                var name = $('#name').val();
                var data = {
                    id: id,
                    name: name,
                    _token: '{{csrf_token()}}'
                };
                $.ajax({
                    url: '/categorySave',
                    type: 'POST',
                    data: data,
                    success: function(response){
                        if(response.success){
                            M.toast({html: response.message});
                            window.location.href = '/categoryEdit/'+response.id;
                        }else{
                            M.toast({html: response.message});
                        }
                    }
                });
            });
        });     
    </script>
@endsection