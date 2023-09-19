@extends('layout')

@section('title')
    <title>Register</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="content">
        <div class="row card">
            <div class="col offset-s3 s6 card-content">
                <div class="row">
                    <div class="col s12">
                        <span class="card-title">Inicio de Sesión</span>
                    </div>
                    <div class="col s4 input-field">
                        <input placeholder="" id="email" type="text" class="validate">
                        <label for="email">Email</label>
                    </div>
                    <div class="col s6 input-field">
                        <input placeholder="" id="password" type="password" class="validate">
                        <label for="password">Contraseña</label>
                    </div>
                    <div class="col s12">
                        <a href="javascript:;" class="btn" id="login">Iniciar Sesión</a>
                        <a href="javascript:;" class="btn" id="forget">He olvidado la contraseña</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#login').click(function(){
                var email = $('#email').val();
                var password = $('#password').val();
                var token = '{{ csrf_token() }}';
                $.ajax({
                    url: '{{ route('do_login') }}',
                    type: 'POST',
                    data: {
                        email: email,
                        password: password,
                        _token: token
                    },
                    success: function(data){
                        if(data.success){
                            if(data.success == 'admin'){
                                window.location.href = '{{ route('adminPanel') }}';
                            }else if(data.success == 'couple'){
                                window.location.href = '{{ route('saveTheDatePanel') }}';
                            }else if(data.success == 'guest'){
                                window.location.href = '{{ route('guestPanel') }}';
                            }
                        }else{
                            alert(data.error);
                        }
                    }
                });
            })
        });        
    </script>
@endsection