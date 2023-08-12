@extends('Plantilla.Principal')
@section('title','Ingresar Como Docente')
@section('Contenido')
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="jumbotron jumbotron-fluid">
    <div class="container" >
        <div class="jumbo-heading" data-aos="fade-down">
            <h1 style="font-size: 30px;">Iniciar Sesión</h1>
        </div>
    </div>
    <!-- /container -->
</div>


<section id="blogprev-home" data-100-bottom="background-position: 0% 120%;" data-top-bottom="background-position: 0% 100%;" class="skrollable skrollable-before" style="background-position: 0% 120%;">
    <div class=" text-center container" >

        <div class="row justify-content-center justify-content-md-start">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <div class="owl-item cloned" style="width: 350px;text-align: center;">
                    <div class="blog-box">
                        <!-- image -->

                        <!-- blog-box-caption -->
                        <div class="blog-box-caption">
                            <!-- date -->
                            <a href="blog-single.html">
                                <h6>Ingrese usuario y Contraseña.</h6>
                            </a>
                            <!-- /link -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Usuario:<span class="required">*</span></label>
                                    <input type="text" id="usu" placeholder="Usuario" class="form-control input-field" required=""> 
                                </div>
                                <div class="col-md-12">
                                    <label>Contraseña: <span class="required">*</span></label>
                                    <input type="password" id="contra" placeholder="Contraseña" class="form-control input-field" required=""> 
                                </div>
                                <div class="col-md-12" style="padding-top: 5px;">
                                    <div id="mslogin" style="display: none; padding-top: 10px;" class="alert alert-danger" role="alert">
                                        Contraseña Incorrecta!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- blog-box-footer -->
                        <div class="blog-box-footer">
                            <!-- Button -->	 
                            <div class="text-center col-md-12">
                                <a  onclick="$.Entrar()" class="btn btn-primary ">Entrar</a>
                            </div>
                        </div>
                        <!-- /blog-box-footer -->
                    </div></div>  
            </div>
            <div class="col-md-4">

            </div>

        </div>


    </div>
    <!-- /container -->
</section>

{!! Form::open(['url'=>'/Login/EntrarDocente'
,'id'=>'formLogin'])
!!}
{!! Form::close() !!}

@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $("#Men_Tablero").removeClass("nav-item active");
        $("#Men_LogDoc").addClass("nav-item active");
        $.extend({
            Entrar: function () {
                var usuar = $("#usu").val();
                var Passw = $("#contra").val();

                var form = $("#formLogin");
                $("#Usuario").remove();
                $("#Pasw").remove();
                $("#_token").remove();
             
                var token = $("#token").val();
                
                form.append("<input type='hidden' name='Usuario' id='Usuario' value='" + usuar + "'>"
                        + "  <input type='hidden' name='Pasw' id='Pasw' value='" + Passw + "'>");
                form.append("<input type='hidden' name='_token' id='_token' value='" + token + "'>");
                var url = form.attr("action");
                var datos = form.serialize();
                $.ajax({
                    type: "post",
                    url: url,
                    data: datos,
                    success: function (respuesta) {
                        if (respuesta.Mensaje === "si") {
                            location.href = '/Contenido/AsignaturasxDoce';
                        } else {
                            $("#mslogin").show();
                        }


                    }
                });
            }
        });
    });
</script>
@endsection