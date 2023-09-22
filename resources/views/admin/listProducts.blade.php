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
                <div class="col s3 input-field">
                    <select id="size_filter">
                        <option value="0" {{$size==0?'selected':''}}>Todos</option>
                        @if(!empty($sizes))
                            @foreach($sizes as $_size)
                                <option value="{{$_size->size}}" {{$_size->size == $size ? 'selected' : ''}}>{{$_size->size}}</option>
                            @endforeach
                        @endif
                    </select>
                    <label for="size_filter">Tallas</label>
                </div>
                <div class="col s3 input-field">
                    <select id="quality_filter">
                        <option value="0" {{$quality==0?'selected':''}}>Todos</option>
                        @if(!empty($qualities))
                            @foreach($qualities as $_quality)
                                <option value="{{$_quality->quality}}" {{$_quality->quality == $quality ? 'selected' : ''}}>{{$_quality->quality}}</option>
                            @endforeach
                        @endif
                    </select>
                    <label for="quality_filter">Gama</label>
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
                <div class="col s3 input-field">
                    <select id="category_filter">
                        <option value="0" {{$category==0?'selected':''}}>Todos</option>
                        @if(!empty($categories))
                            @foreach($categories as $_category)
                                <option value="{{$_category->id}}" {{$_category->id == $category ? 'selected' : ''}}>{{$_category->name}}</option>
                            @endforeach
                        @endif
                    </select>     
                    <label for="category_filter">Categoría</label>               
                </div>
            </div>
        </div>
    </div>
    <div class="row card">
        <div class="col s12 card-content">
            <span class="card-title">Productos</span>
            <div class="row table">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tamaño</th>
                            <th>Calidad</th>
                            <th>Estado</th>
                            <th>Integridad</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($products))
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->size}}</td>
                                    <td>{{$product->quality}}</td>
                                    <td>{{$product->status}}</td>
                                    <td>{{$product->health}}</td>
                                    <td>
                                        <a href="/productEdit/{{$product->id}}" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">edit</i></a>
                                        <a href="#" class="btn-floating btn-small waves-effect waves-light red deleteProduct" data-id="{{$product->id}}"><i class="material-icons">delete</i></a>
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
            <a href="/productEdit/0" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
        </div>
    </div>    
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.deleteProduct').click(function(){
                if(confirm('¿Seguro que desea borrar este producto? la acción NO será reversible')){
                    var id = $(this).data('id');
                    var token = '{{csrf_token()}}';
                    $.ajax({
                        url: '/cityDelete/',
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
        });        
    </script>
@endsection