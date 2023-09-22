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
            <span class="card-title">Panel BigFootSky</span>
        </div>
        <div class="col s12">
            <p align="center">KPIs de contenido</p>
        </div>
        <div class="col s12">
            <div class="row">
                <div class="col s12 card">
                    <div class="card-content">
                        <span class="card-title">Productos</span>
                        <table>
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Libres</th>
                                    <th>Ocupados</th>
                                    <th>Mantenimiento</th>
                                    <th>Total</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Skies</td>
                                    <td>10</td>
                                    <td>10</td>
                                    <td>10</td>
                                    <td>40</td>
                                    <td><a href="javascript:;">Ver</a></td>
                                </tr>
                                <tr>
                                    <td>Botas Skies</td>
                                    <td>10</td>
                                    <td>10</td>
                                    <td>10</td>
                                    <td>40</td>
                                    <td><a href="javascript:;">Ver</a></td>
                                </tr>
                                <tr>
                                    <td>Snowboard</td>
                                    <td>10</td>
                                    <td>10</td>
                                    <td>10</td>
                                    <td>40</td>
                                    <td><a href="javascript:;">Ver</a></td>
                                </tr>
                                <tr>
                                    <td>Botas Snowboard</td>
                                    <td>10</td>
                                    <td>10</td>
                                    <td>10</td>
                                    <td>40</td>
                                    <td><a href="javascript:;">Ver</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col s6 l4 card">
                    <div class="card-content">
                        <span class="card-title">Profesores</span>
                        <p>10</p>
                    </div>
                </div>
                <div class="col s6 l4 card">
                    <div class="card-content">
                        <span class="card-title">Clientes</span>
                        <p>10</p>
                    </div>
                </div>
                <div class="col s6 l4 card">
                    <div class="card-content">
                        <span class="card-title">Hoy</span>
                        <p>10 cursos</p>
                        <p>10 clases particulares</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
        });        
    </script>
@endsection