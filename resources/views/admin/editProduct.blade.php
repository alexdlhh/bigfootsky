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
                                <option value="{{$_category->id}}" {{$_category->id == $product['category'] ? 'selected' : ''}}>{{$_category->name}}</option>
                            @endforeach
                        @endif
                    </select>     
                    <label for="category_product">Categoría</label> 
                </div>
                <div class="col s3 input-field">
                    <select id="size_product">
                        @if(!empty($sizes))
                            @foreach($sizes as $_size)
                                <option value="{{$_size->size}}" {{$_size->size == $size ? 'selected' : ''}}>{{$_size->size}}</option>
                            @endforeach
                        @endif
                    </select>
                    <label for="size_product">Tallas</label>
                </div>
                <div class="col s3 input-field">
                    <select id="quality_product">
                        @if(!empty($qualities))
                            @foreach($qualities as $_quality)
                                <option value="{{$_quality->quality}}" {{$_quality->quality == $quality ? 'selected' : ''}}>{{$_quality->quality}}</option>
                            @endforeach
                        @endif
                    </select>
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
                <div class="col s12">
                    <textarea id="descripcion_product">{{$city['descripcion'] ?? ''}}</textarea>
                </div>
                <div class="col s12 padding">
                    <a href="javascript:;" class="btn" id="saveCity">Guardar</a>
                </div>
            </div>
        </div>
    </div>
    <input type="text" id="id" value="{{$product['id'] ?? $id}}" hidden>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.0.0/tinymce.min.js"></script>
    <script>
        var textareas = ['#descripcion_product'];
        $.each(textareas,function(index,textarea){
            tinymce.init({
                selector: textarea,
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
            });
        });
        $(document).ready(function(){
        });     
    </script>
@endsection