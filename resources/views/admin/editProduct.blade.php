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
            <span class="card-title">{{!empty($product['id'])?$product['name']:'Crear Producto'}}</span>
            
            <div class="row" id="basic">
                <div class="col s6 input-field">
                    <input type="text" id="name_product" value="{{!empty($product['name'])?$product['name']:''}}">
                    <label for="name_product">Nombre de Producto</label>
                </div>
                <div class="col s6 input-field">
                    <select id="category_product">
                        @if(!empty($categories))
                            @foreach($categories as $_category)
                                <option value="{{$_category->id}}" {{!empty($product) && $_category->id == $product['category'] ? 'selected' : ''}}>{{$_category->name}}</option>
                            @endforeach
                        @endif
                    </select>     
                    <label for="category_product">Categoría</label> 
                </div>
                <div class="col s3 input-field">
                    <input type="text" id="size_product" value="{{!empty($product['size'])?$product['size']:''}}">
                    <label for="size_product">Talla</label>
                </div>
                <div class="col s3 input-field">
                    <input type="text" id="quality_product" value="{{!empty($product['quality'])?$product['quality']:''}}">
                    <label for="quality_product">Gama</label>
                </div>
                <div class="col s3 input-field">
                    <select id="status_product">
                        <option value="1" {{!empty($product['status']) && $product['status']==1?'selected':''}}>Libre</option>
                        <option value="2" {{!empty($product['status']) && $product['status']==2?'selected':''}}>Alquilado</option>
                        <option value="3" {{!empty($product['status']) && $product['status']==3?'selected':''}}>Mantenimiento</option>
                    </select>
                    <label for="status_product">Estado</label>
                </div>
                <div class="col s3 input-field">
                    <select id="health_product">
                        <option value="1" {{!empty($product['health']) && $product['health']==1?'selected':''}}>Peligroso</option>
                        <option value="2" {{!empty($product['health']) && $product['health']==2?'selected':''}}>Muy Malo</option>
                        <option value="3" {{!empty($product['health']) && $product['health']==3?'selected':''}}>Malo</option>
                        <option value="4" {{!empty($product['health']) && $product['health']==4?'selected':''}}>Desperfecto Grave</option>
                        <option value="5" {{!empty($product['health']) && $product['health']==5?'selected':''}}>Desperfecto Leve</option>
                        <option value="6" {{!empty($product['health']) && $product['health']==6?'selected':''}}>Regular</option>
                        <option value="7" {{!empty($product['health']) && $product['health']==7?'selected':''}}>Usado</option>
                        <option value="8" {{!empty($product['health']) && $product['health']==8?'selected':''}}>Bueno</option>
                        <option value="9" {{!empty($product['health']) && $product['health']==9?'selected':''}}>Muy Bueno</option>
                        <option value="10" {{!empty($product['health']) && $product['health']==10?'selected':''}}>Nuevo</option>
                    </select>
                    <label for="health_product">Integridad</label>
                </div>
                <div class="col s12 padding">
                    <a href="javascript:;" class="btn" id="saveProduct">Guardar</a>
                </div>
            </div>
        </div>
    </div>
    <input type="text" id="id" value="{{$product['id'] ?? $id}}" hidden>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#saveProduct').click(function(){
                var id = $('#id').val();
                var name = $('#name_product').val();
                var category = $('#category_product').val();
                var size = $('#size_product').val();
                var quality = $('#quality_product').val();
                var status = $('#status_product').val();
                var health = $('#health_product').val();
                var data = {
                    id:id,
                    name:name,
                    category:category,
                    size:size,
                    quality:quality,
                    status:status,
                    health:health,
                    _token:'{{csrf_token()}}'
                };
                $.ajax({
                    url:'/productSave',
                    type:'POST',
                    data:data,
                    success:function(data){
                        if(data.success){
                            M.toast({html: data.message});
                            setTimeout(function(){
                                M.toast({html: data.message});
                                window.location.href = '/products';
                            },1000);
                        }else{
                            M.toast({html: data.message});
                        }
                    }
                });
            });
        });     
    </script>
@endsection