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
            <span class="card-title">{{!empty($teacher['id'])?$teacher['name']:'Profesor'}}</span>
            
            <div class="row" id="basic">
                <div class="col s4 input-field">
                    <input type="text" id="name" value="{{!empty($teacher['name'])?$teacher['name']:''}}">
                    <label for="name">Nombre</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="dni" value="{{!empty($teacher['dni'])?$teacher['dni']:''}}">
                    <label for="dni">DNI</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="email" value="{{!empty($teacher['email'])?$teacher['email']:''}}">
                    <label for="email">Email</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="phone" value="{{!empty($teacher['phone'])?$teacher['phone']:''}}">
                    <label for="phone">Teléfono</label>
                </div>
                <div class="col s4 input-field">
                    @php
                        $teacher['langs'] = explode(',',$teacher['langs']);
                    @endphp
                    <select id="langs" multiple>
                        <option value="es" {{!empty($teacher['langs'])&&in_array('es',$teacher['langs'])?'selected':''}}>Español</option>
                        <option value="en" {{!empty($teacher['langs'])&&in_array('en',$teacher['langs'])?'selected':''}}>Inglés</option>
                        <option value="fr" {{!empty($teacher['langs'])&&in_array('fr',$teacher['langs'])?'selected':''}}>Francés</option>
                        <option value="de" {{!empty($teacher['langs'])&&in_array('de',$teacher['langs'])?'selected':''}}>Alemán</option>
                        <option value="it" {{!empty($teacher['langs'])&&in_array('it',$teacher['langs'])?'selected':''}}>Italiano</option>
                        <option value="pt" {{!empty($teacher['langs'])&&in_array('pt',$teacher['langs'])?'selected':''}}>Portugués</option>
                    </select>
                    <label for="langs">Idiomas</label>
                </div>
                <div class="col s4 input-field">
                    <select id="type">
                        <option value="interno" {{!empty($teacher['type'])&&$teacher['type']=='interno'?'selected':''}}>Interno</option>
                        <option value="externo" {{!empty($teacher['type'])&&$teacher['type']=='externo'?'selected':''}}>Externo</option>
                    </select>
                    <label for="type">Interno/Externo</label>
                </div>
                <div class="col s4 input-field">
                    <select id="modality">
                        <option value="ski" {{!empty($teacher['modality'])&&$teacher['modality']=='ski'?'selected':''}}>SKI</option>
                        <option value="snowboard" {{!empty($teacher['modality'])&&$teacher['modality']=='snowboard'?'selected':''}}>SNOWBOARD</option>
                    </select>
                    <label for="modality">Modalidad</label>
                </div>
                <div class="col s4 input-field">
                    <label for="days">Días</label>
                    <select id="days" multiple>
                        <option value="1" {{!empty($teacher['days'])&&$teacher['days']=='1'?'selected':''}}>Lunes</option>
                        <option value="2" {{!empty($teacher['days'])&&$teacher['days']=='2'?'selected':''}}>Martes</option>
                        <option value="3" {{!empty($teacher['days'])&&$teacher['days']=='3'?'selected':''}}>Miércoles</option>
                        <option value="4" {{!empty($teacher['days'])&&$teacher['days']=='4'?'selected':''}}>Jueves</option>
                        <option value="5" {{!empty($teacher['days'])&&$teacher['days']=='5'?'selected':''}}>Viernes</option>
                        <option value="6" {{!empty($teacher['days'])&&$teacher['days']=='6'?'selected':''}}>Sábado</option>
                        <option value="7" {{!empty($teacher['days'])&&$teacher['days']=='7'?'selected':''}}>Domingo</option>
                    </select>
                </div>
                <div class="col s12">
                    <div class="row">
                        <div class="col s3">
                            <label for="times">Lunes Horas</label>
                            <select id="times_monday" multiple>
                                <option value="1" {{!empty($teacher['disponibility'][1])&&in_array('1',$teacher['disponibility'][1])?'selected':''}}>9:00</option>
                                <option value="2" {{!empty($teacher['disponibility'][1])&&in_array('2',$teacher['disponibility'][1])?'selected':''}}>10:00</option>
                                <option value="3" {{!empty($teacher['disponibility'][1])&&in_array('3',$teacher['disponibility'][1])?'selected':''}}>11:00</option>
                                <option value="4" {{!empty($teacher['disponibility'][1])&&in_array('4',$teacher['disponibility'][1])?'selected':''}}>12:00</option>
                                <option value="5" {{!empty($teacher['disponibility'][1])&&in_array('5',$teacher['disponibility'][1])?'selected':''}}>13:00</option>
                                <option value="6" {{!empty($teacher['disponibility'][1])&&in_array('6',$teacher['disponibility'][1])?'selected':''}}>14:00</option>
                                <option value="7" {{!empty($teacher['disponibility'][1])&&in_array('7',$teacher['disponibility'][1])?'selected':''}}>15:00</option>
                                <option value="8" {{!empty($teacher['disponibility'][1])&&in_array('8',$teacher['disponibility'][1])?'selected':''}}>16:00</option>
                                <option value="9" {{!empty($teacher['disponibility'][1])&&in_array('9',$teacher['disponibility'][1])?'selected':''}}>17:00</option>
                                <option value="10" {{!empty($teacher['disponibility'][1])&&in_array('10',$teacher['disponibility'][1])?'selected':''}}>18:00</option>
                                <option value="11" {{!empty($teacher['disponibility'][1])&&in_array('11',$teacher['disponibility'][1])?'selected':''}}>19:00</option>
                                <option value="12" {{!empty($teacher['disponibility'][1])&&in_array('12',$teacher['disponibility'][1])?'selected':''}}>20:00</option>
                            </select>
                        </div>
                        <div class="col s3">
                            <label for="times">Martes Horas</label>
                            <select id="times_tuesday" multiple>
                                <option value="1" {{!empty($teacher['disponibility'][2])&&in_array('1',$teacher['disponibility'][2])?'selected':''}}>9:00</option>
                                <option value="2" {{!empty($teacher['disponibility'][2])&&in_array('2',$teacher['disponibility'][2])?'selected':''}}>10:00</option>
                                <option value="3" {{!empty($teacher['disponibility'][2])&&in_array('3',$teacher['disponibility'][2])?'selected':''}}>11:00</option>
                                <option value="4" {{!empty($teacher['disponibility'][2])&&in_array('4',$teacher['disponibility'][2])?'selected':''}}>12:00</option>
                                <option value="5" {{!empty($teacher['disponibility'][2])&&in_array('5',$teacher['disponibility'][2])?'selected':''}}>13:00</option>
                                <option value="6" {{!empty($teacher['disponibility'][2])&&in_array('6',$teacher['disponibility'][2])?'selected':''}}>14:00</option>
                                <option value="7" {{!empty($teacher['disponibility'][2])&&in_array('7',$teacher['disponibility'][2])?'selected':''}}>15:00</option>
                                <option value="8" {{!empty($teacher['disponibility'][2])&&in_array('8',$teacher['disponibility'][2])?'selected':''}}>16:00</option>
                                <option value="9" {{!empty($teacher['disponibility'][2])&&in_array('9',$teacher['disponibility'][2])?'selected':''}}>17:00</option>
                                <option value="10" {{!empty($teacher['disponibility'][2])&&in_array('10',$teacher['disponibility'][2])?'selected':''}}>18:00</option>
                                <option value="11" {{!empty($teacher['disponibility'][2])&&in_array('11',$teacher['disponibility'][2])?'selected':''}}>19:00</option>
                                <option value="12" {{!empty($teacher['disponibility'][2])&&in_array('12',$teacher['disponibility'][2])?'selected':''}}>20:00</option>
                            </select>
                        </div>
                        <div class="col s3">
                            <label for="times">Miércoles Horas</label>
                            <select id="times_wednesday" multiple>
                                <option value="1" {{!empty($teacher['disponibility'][3])&&in_array('1',$teacher['disponibility'][3])?'selected':''}}>9:00</option>
                                <option value="2" {{!empty($teacher['disponibility'][3])&&in_array('2',$teacher['disponibility'][3])?'selected':''}}>10:00</option>
                                <option value="3" {{!empty($teacher['disponibility'][3])&&in_array('3',$teacher['disponibility'][3])?'selected':''}}>11:00</option>
                                <option value="4" {{!empty($teacher['disponibility'][3])&&in_array('4',$teacher['disponibility'][3])?'selected':''}}>12:00</option>
                                <option value="5" {{!empty($teacher['disponibility'][3])&&in_array('5',$teacher['disponibility'][3])?'selected':''}}>13:00</option>
                                <option value="6" {{!empty($teacher['disponibility'][3])&&in_array('6',$teacher['disponibility'][3])?'selected':''}}>14:00</option>
                                <option value="7" {{!empty($teacher['disponibility'][3])&&in_array('7',$teacher['disponibility'][3])?'selected':''}}>15:00</option>
                                <option value="8" {{!empty($teacher['disponibility'][3])&&in_array('8',$teacher['disponibility'][3])?'selected':''}}>16:00</option>
                                <option value="9" {{!empty($teacher['disponibility'][3])&&in_array('9',$teacher['disponibility'][3])?'selected':''}}>17:00</option>
                                <option value="10" {{!empty($teacher['disponibility'][3])&&in_array('10',$teacher['disponibility'][3])?'selected':''}}>18:00</option>
                                <option value="11" {{!empty($teacher['disponibility'][3])&&in_array('11',$teacher['disponibility'][3])?'selected':''}}>19:00</option>
                                <option value="12" {{!empty($teacher['disponibility'][3])&&in_array('12',$teacher['disponibility'][3])?'selected':''}}>20:00</option>
                            </select>
                        </div>
                        <div class="col s3">
                            <label for="times">Jueves Horas</label>
                            <select id="times_thursday" multiple>
                                <option value="1" {{!empty($teacher['disponibility'][4])&&in_array('1',$teacher['disponibility'][4])?'selected':''}}>9:00</option>
                                <option value="2" {{!empty($teacher['disponibility'][4])&&in_array('2',$teacher['disponibility'][4])?'selected':''}}>10:00</option>
                                <option value="3" {{!empty($teacher['disponibility'][4])&&in_array('3',$teacher['disponibility'][4])?'selected':''}}>11:00</option>
                                <option value="4" {{!empty($teacher['disponibility'][4])&&in_array('4',$teacher['disponibility'][4])?'selected':''}}>12:00</option>
                                <option value="5" {{!empty($teacher['disponibility'][4])&&in_array('5',$teacher['disponibility'][4])?'selected':''}}>13:00</option>
                                <option value="6" {{!empty($teacher['disponibility'][4])&&in_array('6',$teacher['disponibility'][4])?'selected':''}}>14:00</option>
                                <option value="7" {{!empty($teacher['disponibility'][4])&&in_array('7',$teacher['disponibility'][4])?'selected':''}}>15:00</option>
                                <option value="8" {{!empty($teacher['disponibility'][4])&&in_array('8',$teacher['disponibility'][4])?'selected':''}}>16:00</option>
                                <option value="9" {{!empty($teacher['disponibility'][4])&&in_array('9',$teacher['disponibility'][4])?'selected':''}}>17:00</option>
                                <option value="10" {{!empty($teacher['disponibility'][4])&&in_array('10',$teacher['disponibility'][4])?'selected':''}}>18:00</option>
                                <option value="11" {{!empty($teacher['disponibility'][4])&&in_array('11',$teacher['disponibility'][4])?'selected':''}}>19:00</option>
                                <option value="12" {{!empty($teacher['disponibility'][4])&&in_array('12',$teacher['disponibility'][4])?'selected':''}}>20:00</option>
                            </select>
                        </div>
                        <div class="col s3">
                            <label for="times">Viernes Horas</label>
                            <select id="times_friday" multiple>
                                <option value="1" {{!empty($teacher['disponibility'][5])&&in_array('1',$teacher['disponibility'][5])?'selected':''}}>9:00</option>
                                <option value="2" {{!empty($teacher['disponibility'][5])&&in_array('2',$teacher['disponibility'][5])?'selected':''}}>10:00</option>
                                <option value="3" {{!empty($teacher['disponibility'][5])&&in_array('3',$teacher['disponibility'][5])?'selected':''}}>11:00</option>
                                <option value="4" {{!empty($teacher['disponibility'][5])&&in_array('4',$teacher['disponibility'][5])?'selected':''}}>12:00</option>
                                <option value="5" {{!empty($teacher['disponibility'][5])&&in_array('5',$teacher['disponibility'][5])?'selected':''}}>13:00</option>
                                <option value="6" {{!empty($teacher['disponibility'][5])&&in_array('6',$teacher['disponibility'][5])?'selected':''}}>14:00</option>
                                <option value="7" {{!empty($teacher['disponibility'][5])&&in_array('7',$teacher['disponibility'][5])?'selected':''}}>15:00</option>
                                <option value="8" {{!empty($teacher['disponibility'][5])&&in_array('8',$teacher['disponibility'][5])?'selected':''}}>16:00</option>
                                <option value="9" {{!empty($teacher['disponibility'][5])&&in_array('9',$teacher['disponibility'][5])?'selected':''}}>17:00</option>
                                <option value="10" {{!empty($teacher['disponibility'][5])&&in_array('10',$teacher['disponibility'][5])?'selected':''}}>18:00</option>
                                <option value="11" {{!empty($teacher['disponibility'][5])&&in_array('11',$teacher['disponibility'][5])?'selected':''}}>19:00</option>
                                <option value="12" {{!empty($teacher['disponibility'][5])&&in_array('12',$teacher['disponibility'][5])?'selected':''}}>20:00</option>
                            </select>
                        </div>
                        <div class="col s3">
                            <label for="times">Sábado Horas</label>
                            <select id="times_saturday" multiple>
                                <option value="1" {{!empty($teacher['disponibility'][6])&&in_array('1',$teacher['disponibility'][6])?'selected':''}}>9:00</option>
                                <option value="2" {{!empty($teacher['disponibility'][6])&&in_array('2',$teacher['disponibility'][6])?'selected':''}}>10:00</option>
                                <option value="3" {{!empty($teacher['disponibility'][6])&&in_array('3',$teacher['disponibility'][6])?'selected':''}}>11:00</option>
                                <option value="4" {{!empty($teacher['disponibility'][6])&&in_array('4',$teacher['disponibility'][6])?'selected':''}}>12:00</option>
                                <option value="5" {{!empty($teacher['disponibility'][6])&&in_array('5',$teacher['disponibility'][6])?'selected':''}}>13:00</option>
                                <option value="6" {{!empty($teacher['disponibility'][6])&&in_array('6',$teacher['disponibility'][6])?'selected':''}}>14:00</option>
                                <option value="7" {{!empty($teacher['disponibility'][6])&&in_array('7',$teacher['disponibility'][6])?'selected':''}}>15:00</option>
                                <option value="8" {{!empty($teacher['disponibility'][6])&&in_array('8',$teacher['disponibility'][6])?'selected':''}}>16:00</option>
                                <option value="9" {{!empty($teacher['disponibility'][6])&&in_array('9',$teacher['disponibility'][6])?'selected':''}}>17:00</option>
                                <option value="10" {{!empty($teacher['disponibility'][6])&&in_array('10',$teacher['disponibility'][6])?'selected':''}}>18:00</option>
                                <option value="11" {{!empty($teacher['disponibility'][6])&&in_array('11',$teacher['disponibility'][6])?'selected':''}}>19:00</option>
                                <option value="12" {{!empty($teacher['disponibility'][6])&&in_array('12',$teacher['disponibility'][6])?'selected':''}}>20:00</option>
                            </select>
                        </div>
                        <div class="col s3">
                            <label for="times">Domingo Horas</label>
                            <select id="times_sunday" multiple>
                                <option value="1" {{!empty($teacher['disponibility'][7])&&in_array('1',$teacher['disponibility'][7])?'selected':''}}>9:00</option>
                                <option value="2" {{!empty($teacher['disponibility'][7])&&in_array('2',$teacher['disponibility'][7])?'selected':''}}>10:00</option>
                                <option value="3" {{!empty($teacher['disponibility'][7])&&in_array('3',$teacher['disponibility'][7])?'selected':''}}>11:00</option>
                                <option value="4" {{!empty($teacher['disponibility'][7])&&in_array('4',$teacher['disponibility'][7])?'selected':''}}>12:00</option>
                                <option value="5" {{!empty($teacher['disponibility'][7])&&in_array('5',$teacher['disponibility'][7])?'selected':''}}>13:00</option>
                                <option value="6" {{!empty($teacher['disponibility'][7])&&in_array('6',$teacher['disponibility'][7])?'selected':''}}>14:00</option>
                                <option value="7" {{!empty($teacher['disponibility'][7])&&in_array('7',$teacher['disponibility'][7])?'selected':''}}>15:00</option>
                                <option value="8" {{!empty($teacher['disponibility'][7])&&in_array('8',$teacher['disponibility'][7])?'selected':''}}>16:00</option>
                                <option value="9" {{!empty($teacher['disponibility'][7])&&in_array('9',$teacher['disponibility'][7])?'selected':''}}>17:00</option>
                                <option value="10" {{!empty($teacher['disponibility'][7])&&in_array('10',$teacher['disponibility'][7])?'selected':''}}>18:00</option>
                                <option value="11" {{!empty($teacher['disponibility'][7])&&in_array('11',$teacher['disponibility'][7])?'selected':''}}>19:00</option>
                                <option value="12" {{!empty($teacher['disponibility'][7])&&in_array('12',$teacher['disponibility'][7])?'selected':''}}>20:00</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col s12 padding">
                    <a href="javascript:;" class="btn" id="saveTeacher">Guardar</a>
                </div>
            </div>
        </div>
    </div>
    <input type="text" id="id" value="{{$teacher['id'] ?? 0}}" hidden>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('select').formSelect();
            $('#saveTeacher').click(function(){
                var id = $('#id').val();
                var name = $('#name').val();
                var surname = $('#surname').val();
                var dni = $('#dni').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var langs = $('#langs').val();
                var type = $('#type').val();
                var data = {
                    id: id,
                    name: name,
                    dni: dni,
                    email: email,
                    phone: phone,
                    langs: langs,
                    type: type,
                    _token: '{{csrf_token()}}'
                };
                $.ajax({
                    url: '/teacherSave',
                    type: 'POST',
                    data: data,
                    success: function(response){
                        if(response.status){
                            M.toast({html: response.message});
                            window.location.href = '/teacherEdit/'+response.id;
                        }else{
                            alert(response.message);
                        }
                    }
                });
            });
        });     
    </script>
@endsection