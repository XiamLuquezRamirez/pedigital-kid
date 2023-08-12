@extends('Plantilla.Principal')
@section('title','Estudiantes')
@section('Contenido')
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="jumbotron jumbotron-fluid">
    <div class="container" >
        <div class="jumbo-heading" data-aos="fade-down">
            <h1 style="font-size: 30px;">Listado de Estudiantes por Grupo</h1>
        </div>
    </div>
    <!-- /container -->
</div>
<section id="gallery-home" class="container-fluid bg-tertiary no-bg-sm">
    <div class="container">
        <div id="page-wrapper" style="padding-top:20px;">
            <!-- Jumbotron -->

            <!-- /jumbotron -->
            <!-- ==== Page Content ==== -->
            <div class="page container" style="padding-top:0px;background: none;">

                <!-- centered Gallery navigation -->
                <ul class="nav nav-pills center-nav">
                    @php 
                    $active="active";
                    @endphp 
                    @foreach($ParGrupos as $Grupos)  
                    <li class="nav-item">
                        @if($Grupos->id==$Grup)
                        <a class="nav-link {!! $active !!}" href="{{url('/Contenido/GradosxEstud2/'.$Grad.'/'.$Grupos->grupo)}}">{!! $Grupos->descripcion !!}</a>
                        @else
                        <a class="nav-link" href="{{url('/Contenido/GradosxEstud2/'.$Grad.'/'.$Grupos->grupo)}}">{!! $Grupos->descripcion !!}</a>
                        @endif

                    </li>
                    @php 

                    @endphp
                    @endforeach

                </ul>
                <!-- /ul -->
                <!-- Gallery -->
                <br>
                <div class="row">
                
                    @foreach($Estud as $Est)  
                    <div data-aos="zoom-out" class="col-col-md-3 col-lg-3 {{$Est->grupo}}">
                        <!--widget-area -->
                        <div class="widget-area notepad">
                            <h5 class="sidebar-header">{!! $Est->nombre_alumno.' '.$Est->apellido_alumno !!}</h5>
                            <!-- widget -->		 
                            <div class="widget2">
                                <div class="card">
                                    <div class="card-img">
                                        <!-- image  -->	
                                        <a href="#">
                                            <img class="rounded card-img-top" src="{{Session::get('URL').'/app-assets/images/Img_Estudiantes/'.$Est->foto_alumno}}" alt="">
                                        </a>
                                    </div>
                                    <div id="mslogin_{{$Est->usuario_alumno}}" style="display: none; padding-top: 10px;" class="alert alert-danger" role="alert">
                                        Contraseña Incorrecta!
                                    </div>
                                    <div id="div_{{$Est->usuario_alumno}}" data-ruta="{{asset('/Contenido/GradosxAsignatura/'.$Grad)}}">

                                    </div>
                                    <div class="card-body">
                                        @if(Session::get('PASW')=='NO')
                                        <a  href='{{url('/Contenido/GradosxAsignaturaSinCont/'.$Est->usuario_alumno)}}' class="btn btn-secondary btn-block btn-sm">Entrar</a>
                                        @else
                                        <a id="Btn_HabCon_{{$Est->usuario_alumno}}" onclick="$.HabCont({{$Est->usuario_alumno}});" class="btn btn-secondary btn-block btn-sm">Entrar</a>

                                        @endif
                                    </div>
                                    <!--/card-body -->	
                                </div>
                                <!-- /card -->	
                            </div>
                            <!--/widget2 -->
                        </div>
                    </div>
                    @endforeach

                </div>


                <!-- /gallery-isotope-->	
            </div>

            <!-- /page -->
        </div>

    </div>
    <!-- /container-->
</section>


{!! Form::open(['url' => '/Login/Entrar', 'method' => 'POST', 'id' => 'formLogin2']) !!}
{!! Form::close() !!}


@endsection

@section('scripts')
<script>
    $(document).ready(function () {
    $("#Men_Tablero").removeClass("nav-item active");
    $("#Men_Grados").addClass("nav-item active");
    $.extend({

    HabCont: function (Usu) {

    if ($("#pasw_" + Usu).length > 0){

    var Passw = $("#pasw_" + Usu).val();
    var form = $("#formLogin2");
    $("#Usuario").remove();
    $("#Pasw").remove();

    var token = $("#tokenn").val();
    form.append("<input type='hidden' name='Usuario' id='Usuario' value='" + Usu + "'>"
            + "  <input type='hidden' name='Pasw' id='Pasw' value='" + Passw + "'>");
    var url = form.attr("action");
    var datos = form.serialize();
    var contenido = "";
    
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        url: url,
        data: datos,
        async: true,
        dataType: "json",
            success: function (respuesta) {
            if (respuesta.Mensaje === "si"){
            location.href = $('#div_' + Usu).data("ruta");
            } else{
            $("#mslogin_" + Usu).show();
            }


            }
    });
    } else{
    $(".caja").each(function(index){
    $(this).remove();
    });
    var Text_Cont = '<br><input type="password"  class="form-control caja" name="pasw"  id="pasw_' + Usu + '" placeholder="Contraseña">';
    $("#div_" + Usu).html(Text_Cont);
    $("#pasw_" + Usu).focus();
    }


    }
    });
    });
</script>
@endsection