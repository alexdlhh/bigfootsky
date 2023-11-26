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
                                <option value="{{$_category->id}}" {{!empty($product) && $_category->id == $product['category_id'] ? 'selected' : ''}}>{{$_category->name}}</option>
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
                    <select id="quality_product">
                        <option value="MEDIA-ALTA" {{!empty($product['quality']) && $product['quality']=='MEDIA-ALTA'?'selected':''}}>MEDIA-ALTA</option>
                        <option value="ALTA" {{!empty($product['quality']) && $product['quality']=='ALTA'?'selected':''}}>ALTA</option>
                        <option value="VIP" {{!empty($product['quality']) && $product['quality']=='VIP'?'selected':''}}>VIP</option>
                        <option value="ADULTO" {{!empty($product['quality']) && $product['quality']=='ADULTO'?'selected':''}}>ADULTO</option>
                        <option value="JUNIOR" {{!empty($product['quality']) && $product['quality']=='JUNIOR'?'selected':''}}>JUNIOR</option>
                        <option value="BEBE" {{!empty($product['quality']) && $product['quality']=='BEBE'?'selected':''}}>BEBE</option>
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
                        <option value="0" disabled>Salud</option>
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
                <div class="col s3 input-field">
                    <input type="text" id="precio1" value="{{!empty($product['precio'][1])?$product['precio'][1]:''}}">
                    <label for="precio1">Precio 1 día</label>
                </div>
                <div class="col s3 input-field">
                    <input type="text" id="precio2" value="{{!empty($product['precio'][2])?$product['precio'][2]:''}}">
                    <label for="precio2">Precio 2 días</label>
                </div>
                <div class="col s3 input-field">
                    <input type="text" id="precio3" value="{{!empty($product['precio'][3])?$product['precio'][3]:''}}">
                    <label for="precio">Precio 3 días</label>
                </div>
                <div class="col s3 input-field">
                    <input type="text" id="precio4" value="{{!empty($product['precio'][4])?$product['precio'][4]:''}}">
                    <label for="precio4">Precio 4 días</label>
                </div>
                <div class="col s3 input-field">
                    <input type="text" id="precio5" value="{{!empty($product['precio'][5])?$product['precio'][5]:''}}">
                    <label for="precio5">Precio 5 días</label>
                </div>
                <div class="col s3 input-field">
                    <input type="text" id="precio6" value="{{!empty($product['precio'][6])?$product['precio'][6]:''}}">
                    <label for="precio6">Precio 6 días</label>
                </div>
                <div class="col s3 input-field">
                    <input type="text" id="precio7" value="{{!empty($product['precio'][7])?$product['precio'][7]:''}}">
                    <label for="precio7">Precio 7 días</label>
                </div>
                <div class="col s3 input-field">
                    <input type="text" id="precio7" value="{{!empty($product['precio'][7])?$product['precio'][7]:''}}">
                    <label for="precio8">Precio 8 días</label>
                </div>
                @if(!empty($product['id']))
                <div class="col s12">
                    <img src="/img/qr/{{$product['id']}}.svg" alt="" width="200">
                </div>
                @endif
                <div class="col s12 padding right-align">
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
            $('.modal').modal();
            $('#saveProduct').click(function(){
                var id = $('#id').val();
                var name = $('#name_product').val();
                var category = $('#category_product').val();
                var size = $('#size_product').val();
                var quality = $('#quality_product').val();
                var status = $('#status_product').val();
                var health = $('#health_product').val();
                var precio1 = $('#precio1').val();
                var precio2 = $('#precio2').val();
                var precio3= $('#precio3').val();
                var precio4 = $('#precio4').val();
                var precio5 = $('#precio5').val();
                var precio6 = $('#precio6').val();
                var precio7 = $('#precio7').val();
                var precio8 = $('#precio8').val();
                var data = {
                    id:id,
                    name:name,
                    category:category,
                    size:size,
                    quality:quality,
                    status:status,
                    health:health,
                    precio1:precio1,
                    precio2:precio2,
                    precio3:precio3,
                    precio4:precio4,
                    precio5:precio5,
                    precio6:precio6,
                    precio7:precio7,
                    precio8:precio8,
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