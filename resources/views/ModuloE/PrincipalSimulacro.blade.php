@extends('Plantilla.Principal')
@section('title', 'Módulo de Entrenamiento - Simulacros')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" class="form-control" id="Ruta" data-ruta="{{ Session::get('URL') }}/app-assets/" />
    <input type="hidden" data-id='id-dat' id="Respdattaller"
        data-ruta="{{ asset('/app-assets/Archivos_EvalTaller_Resp') }}" />
    <input type="hidden" class="form-control" id="IdEval" value="" />
    <input type="hidden" class="form-control" id="tiempEvaluacion" value="" />
    <input type="hidden" class="form-control" name="CargArchi" id="CargArchi" value="" />
    <input type="hidden" class="form-control" id="Id_Doce" value="{{ Session::get('DOCENTE') }}" />
    <input type="hidden" class="form-control" name="sesion_id" id="sesion_id" value="" />
    <input type="hidden" class="form-control" name="simulacro_id" id="simulacro_id" value="" />

    <input type="hidden" class="form-control" name="estaSesion" id="estaSesion" value="" />
    <input type="hidden" class="form-control" name="area_id" id="area_id" value="" />
    <input type="hidden" class="form-control" name="banco_id" id="banco_id" value="" />
    <input type="hidden" class="form-control" name="tema_id" id="tema_id" value="" />
    <input type="hidden" class="form-control" name="NPreg" id="NPreg" value="" />
    <input type="hidden" class="form-control" id="Tip_Usu" value="{{ Auth::user()->tipo_usuario }}" />
    <input type="hidden" name="ruta" id="ruta" value="{{ asset('app-assets/images/') }}">
    <input type="hidden" class="form-control" id="RutaBase" value="{{ url('/') }}/" />

    <input type="hidden" class="form-control" id="h" value="" />
    <input type="hidden" class="form-control" id="m" value="" />
    <input type="hidden" class="form-control" id="s" value="" />
    <input type="hidden" class="form-control" id="tiempo" value="" />
    <input type="hidden" class="form-control" id="tiempoSesiom" value="" />
    <input type="hidden" class="form-control" id="PregActual" value="1" />
    <input type="hidden" class="form-control" id="nsimu" value="" />

    <input type="hidden" class="form-control" id="CompeActual" value="" />
    <input type="hidden" class="form-control" id="CompoActual" value="" />

    <section class="row pb-1" style="margin-left: 20px;margin-right: 20px;">
        <div class="container" style="margin-top: -40px;">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="element-heading col-lg-12" id="Titulo">Listado de Simulacros</h2>
                </div>
                <div class="col-lg-12" id="Div_Simulacros">
                </div>
                <div class="col-lg-12" id="Div_Sesiones" style="display: none;">

                    <div class="card-body" id="Div_ListSesiones">

                    </div>
                    <a class="custom-link float-right mt-2" onclick="$.AtrasSesion();" style="cursor: pointer;"
                        id="btn-atrasSesion">Atras</a>
                </div>
            </div>

            <div class="row" id="div-detSimulacros" style="display: none;">
            </div>

            <div id="Div_PruebaInf" style="display: none;" class="class p-2">
                <div class="contact-info res-margin">
                    <div class="row res-margin">
                        <div class="col-lg-4">
                            <div class="contact-icon bg-secondary text-light" style="padding: 20px 10px 10px 10px">
                                <!---icon-->
                                <i class="fa fa-list-ul top-icon"></i>
                                <!-- contact-icon info-->
                                <div class="contact-icon-info">
                                    <h5 id="num_area"></h5>
                                    <p>Número de Áras</p>
                                </div>
                            </div>
                            <!-- /contact-icon-->
                        </div>
                        <!-- /col-lg-->
                        <div class="col-lg-4 res-margin">
                            <div class="contact-icon bg-secondary text-light" style="padding: 20px 10px 10px 10px">
                                <!---icon-->
                                <i class="fa fa-check top-icon"></i>
                                <!-- contact-icon info-->
                                <div class="contact-icon-info">
                                    <h5 id="num_preg"></h5>
                                    <p>Número de Preguntas</p>
                                </div>
                            </div>
                            <!-- /contact-icon-->
                        </div>
                        <!-- /col-lg -->
                        <div class="col-lg-4 res-margin">
                            <div class="contact-icon bg-secondary text-light" style="padding: 20px 10px 10px 10px">
                                <!---icon-->
                                <i class="fa fa-clock top-icon"></i>
                                <!-- contact-icon info-->
                                <div class="contact-icon-info">
                                    <h5 id="cont_tiempo">00:00:00</h5>
                                    <p>Tiempo Faltante</p>
                                </div>
                            </div>
                            <!-- /contact-icon-->
                        </div>
                        <!-- /col-lg-->
                    </div>
                    <!-- /row -->
                </div>
            </div>

            <div id="Div_Areas" style="display: none;" class="class">
                <div class="card-body">
                    <form method="post" action="{{ url('/') }}/ModuloE/GuardarSesionTiempo"
                        id="GuardarSesionTiempo">
                        <div class="row match-height" id="Div_ListAreas">

                        </div>
                    </form>

                </div>

                <div class="modal-footer" style="text-align: left;">
                    <button type="button" id="btn_guardarTodoSesion" onclick="$.GuardarTodoSesion('Est');"
                        class="btn btn-primary"><i class="fa fa-save position-right">
                        </i> Guardar y Cerrar Todo
                    </button>
                    <button type="button" id="btn_atras" onclick="$.mostSesiones();" class="btn btn-secondary"><i
                            class="fa fa-arrow-left position-right">
                        </i> Atras
                    </button>
                </div>
            </div>

     

            <div id="Div_Preguntas" style="display: none;" class="class">
                <div class="card">
                    <div class="card-body">
                        <article id='DetEval' style="text-transform: capitalize;" class="wrapper">
                            <header style="font-size: 15px; font-weight: bold;"></header>
                            <main style="height: 100%; overflow: auto;"></main>
                        </article>
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="btn_atras" onclick="$.mostAreas();" class="btn grey btn-secondary"><i
                                class="ft-corner-up-left position-right"></i>
                            Atras</button>
                    </div>
                </div>
            </div>

            <a class="custom-link float-right mt-2" onclick="javascript: history.back();" style="cursor: pointer;"
                id="btn-atras">Atras</a>

        </div>
        </div>
    </section>

    {!! Form::open(['url' => '/ModuloE/ConsultarSimulacros', 'id' => 'formAuxiliarSimulacros']) !!}
    {!! Form::close() !!}

    {!! Form::open(['url' => '/ModuloE/ConsultarSesiones', 'id' => 'formAuxiliarSesiones']) !!}
    {!! Form::close() !!}

    {!! Form::open(['url' => '/ModuloE/ConsultarAreasxSesion', 'id' => 'formAuxiliarAreas']) !!}
    {!! Form::close() !!}

    {!! Form::open(['url' => '/ModuloE/ConsultarPreguntasAreas', 'id' => 'formAuxiliarPreguntas']) !!}
    {!! Form::close() !!}

    {!! Form::open(['url' => '/ModuloE/consulPregAlumnoSimu', 'id' => 'formAuxiliarCargEval']) !!}
    {!! Form::close() !!}
    
    {!! Form::open(['url' => '/ModuloE/GuardarSesionEstudiante', 'id' => 'formAuxiliarGuardarSesion']) !!}
    {!! Form::close() !!}

    {!! Form::open(['url' => '/ModuloE/guadarInicioSesion', 'id' => 'formAuxiliarGuardarInicioSesion']) !!}
    {!! Form::close() !!}

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#Men_Tablero").removeClass("nav-item active");
            $("#Men_moduloE").addClass("nav-item active");

            var flagGlobal = "n";
            var flagTimExt = "n";
            var flagTimFin = "n";
            var flagIntent = "ok";
            var xtiempo;
            var tipCont = "";

            CKEDITOR.editorConfig = function(config) {
                config.toolbarGroups = [{
                        name: 'document',
                        groups: ['mode', 'document', 'doctools']
                    },
                    {
                        name: 'clipboard',
                        groups: ['clipboard', 'undo']
                    },
                    {
                        name: 'styles',
                        groups: ['styles']
                    },
                    {
                        name: 'editing',
                        groups: ['find', 'selection', 'spellchecker', 'editing']
                    },
                    {
                        name: 'forms',
                        groups: ['forms']
                    },
                    {
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup']
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
                    },
                    {
                        name: 'links',
                        groups: ['links']
                    },
                    {
                        name: 'insert',
                        groups: ['insert']
                    },
                    {
                        name: 'colors',
                        groups: ['colors']
                    },
                    {
                        name: 'tools',
                        groups: ['tools']
                    },
                    {
                        name: 'others',
                        groups: ['others']
                    },
                    {
                        name: 'about',
                        groups: ['about']
                    }
                ];

                config.removeButtons =
                    'Source,Save,NewPage,ExportPdf,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Replace,Find,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,SelectAll,Button,ImageButton,HiddenField,Strike,CopyFormatting,RemoveFormat,Indent,Blockquote,Outdent,CreateDiv,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,BidiLtr,BidiRtl,Language,Link,Unlink,Anchor,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,Format,BGColor,ShowBlocks,About,Underline,Italic';
            };

            let tiempoTranscurrido = 0;
            let intervalo;


            $.extend({
                MostrarSimulacros: function() {
                    var form = $("#formAuxiliarSimulacros");
                    var url = form.attr("action");
                    var datos = form.serialize();
                    var contenido = '';
                    $("#Titulo").html('SIMULACROS - MÓDULO E');

                    $("#Div_Principal").hide();
                    $("#Div_Simulacros").show();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        dataType: "json",
                        async: false,
                        success: function(respuesta) {

                            $.each(respuesta.Simualacros, function(i, item) {

                                if (item.estado_pres === "NO PRESENTADO") {
                                    var bs_callout = "secondary";
                                    var bg = "bg-info";
                                    var ico = "fa fa-info";

                                } else {

                                    var bs_callout = "info";
                                    var bg = "bg-success";
                                    var ico = "fa fa-check";

                                }
                                var npreg = 0;
                                var n_sesiones = 0;
                                $.each(item.SesionesxSimulacro, function(j, item2) {
                                    npreg = npreg + item2.num_preguntas;
                                    n_sesiones++;

                                });

                                contenido +=
                                    '<div style="cursor: pointer;" data-simu="'+item.nombre+'" id="simi'+item.id+'"  onclick="$.MostrarSesiones(' +
                                    item.id + ');" class="alert alert-' +
                                    bs_callout + '" role="alert">' +
                                    '<strong style="font-size:25px;">' + item
                                    .nombre + '</strong>' +
                                    ' <p style="font-style: italic;"><b>Sesiones:</b> ' +
                                    n_sesiones +
                                    ' <b> - No. Preguntas:</b>' + npreg + '</p> ' +
                                    ' </div>';

                            });


                        }
                    });

                    $("#Div_Simulacros").html(contenido);

                },
                mostSesiones: function(){
                    $("#Div_Sesiones").show();
                    $("#Div_Areas").hide();
                    $("#Div_PruebaInf").hide();
                    $("#Titulo").html($("#nsimu").val()+" - MÓDULO E");
                },
                MostrarSesiones: function(id) {
                    var form = $("#formAuxiliarSesiones");
                    var url = form.attr("action");
                    $("#simulacro_id").val(id);
                    var contenido = '';

                    let nsimulacro = $("#simi"+id).data("simu");
                    $("#nsimu").val(nsimulacro);

                    $("#idSimu").remove();
                    form.append("<input type='hidden' name='idSimu' id='idSimu' value='" + id + "'>");

                    var datos = form.serialize();
                    $("#Div_Simulacros").hide();
                    $("#Div_Sesiones").show();
                    $("#btn-atras").hide();


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        dataType: "json",
                        async: false,
                        success: function(respuesta) {

                            $("#Titulo").html(respuesta.Simulacro.nombre + '- SESIONES');

                            var id = 1;

                            $.each(respuesta.Sesiones, function(i, item) {

                                if (item.habilitado == 1) {
                                    var bs_callout = "success"
                                    var disabled = "block"
                                    var cursor = "pointer";
                                } else {

                                    var bs_callout = "dark";
                                    var disabled = "none";
                                    var cursor = "not-allowed";

                                }


                                var areas = [];
                                $.each(item.AreasxSesiones, function(j, item2) {
                                    areas.push(item2.nombre_area)
                                });

                                var estado = "";
                                var colorEst = "";

                                if (item.estado == "FINALIZADA") {
                                    estado = "FINALIZADA";
                                    colorEst = "#16D39A";
                                } else if (item.estado == "INICIADA") {
                                    estado = "INICIADA";
                                    colorEst = "#2DCEE3";
                                } else {
                                    estado = "PENDIENTE";
                                    colorEst = "#FF7588";
                                }


                                contenido += '<div class="alert alert-' +
                                    bs_callout + ' mb-1" style="cursor: ' + cursor +
                                    '; pointer-events:' + disabled +
                                    '" id="Sesiones' + id + '" data-sesion="' + item
                                    .id + '" data-nombre="' + item.sesion +
                                    '"  onclick="$.MostrarAreas(this.id);" role="alert">' +
                                    '<strong style="font-size:20px; text-transform: capitalize">' +
                                    item.sesion + '</strong> ' +
                                    ' <p style="font-style: italic;"><b>Áreas: </b> ' +
                                    areas.toString() +
                                    ' <b> - No. Preguntas: </b>' + item
                                    .num_preguntas +
                                    ' <b> - Estado:</b> <label style="color: ' +
                                    colorEst + ';">' + estado + '</label></p> ' +
                                    '</div>';
                                id++;

                            });


                        }
                    });

                    $("#Div_ListSesiones").html(contenido);

                },
                AtrasSesion: function() {
                    $("#Div_Simulacros").show();
                    $("#Div_Sesiones").hide();
                    $("#btn-atras").show();
                    $("#Titulo").html("SIMULACROS - MÓDULO E");

                },
                MostrarAreas: function(id) {


                    if (localStorage.getItem('sesionIniciada')) {
                        localStorage.setItem('sesionIniciada', 'Si');
                    } else {
                        localStorage.setItem('sesionIniciada', 'No');
                    }

                    var form = $("#formAuxiliarAreas");
                    var url = form.attr("action");
                    var datos = form.serialize();

                    var idsesion = $("#" + id).data("sesion");
                    var nomsesion = $("#" + id).data("nombre");

                    var contenido = '';
                    $("#Titulo").html(nomsesion + ' - MÓDULO E');

                    $("#idSesi").remove();
                    form.append("<input type='hidden' name='idSesi' id='idSesi' value='" + idsesion +
                        "'>");

                    var datos = form.serialize();
                    $("#Div_Areas").show();
                    $("#Div_Sesiones").hide();
                    var ruta = $("#Ruta").data("ruta");


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        dataType: "json",
                        async: false,
                        success: function(respuesta) {

                            $("#num_area").html(respuesta.SesAre.length);
                            $("#num_preg").html(respuesta.Sesion.num_preguntas);
                            $("#tiempo_sesion").html(respuesta.Sesion.tiempo_sesion +
                                ":00");
                            $("#tiempo").val(respuesta.Sesion.tiempo_sesion);

                            var estaSesion = respuesta.Sesion.estado;

                            $("#estaSesion").val(estaSesion);
                            if (estaSesion == "FINALIZADA") {
                                $("#btn_guardarTodoSesion").hide();
                            } else {
                                $("#btn_guardarTodoSesion").show();

                            }

                            var npreg = respuesta.Sesion.num_preguntas;
                            var nPreguntasResuletas = 0;

                            $.each(respuesta.SesAre, function(i, item) {

                                var PreAct = "";
                                if (item.resp_preguntas == null) {
                                    PreAct = "0";
                                } else {
                                    PreAct = item.resp_preguntas;
                                }
                                nPreguntasResuletas = nPreguntasResuletas + item
                                    .resp_preguntas;


                                contenido +=
                                    '<div data-aos="zoom-out" class="col-xl-4 col-md-6 col-12"><div class="col-md-12 widget-area notepad">' +
                                    ' <div class="team_img">' +
                                    '  <a href="#">' +
                                    '   <img src="' + ruta + 'images/Img_ModuloE/' +
                                    item.imagen +
                                    '" class="rounded-circle img-fluid" alt="">' +
                                    '  </a>' +
                                    ' <a href="#" style="font-size:24px;"><i class="fa fa-question"> ' +
                                    PreAct + '/' + item.npreguntas + '</i></a>' +
                                    ' </div>' +
                                    '<div class="team-content">' +
                                    '<a href="#">' +
                                    '<h5 class="title">' + item.nombre_area +
                                    '</h5>' +
                                    '   </a>'
                                if (item.estadoarea == "EN PROCESO") {
                                    contenido +=
                                        '<button type="button" onclick="$.MostrarPrueba(' +
                                        item.idSesion +
                                        ');" class="btn btn-warning"><i class="fa fa-info-circle"></i> En Proceso</button>';
                                } else if (item.estadoarea == "TERMINADA") {
                                    contenido +=
                                        '<button type="button" onclick="$.MostrarPrueba(' +
                                        item.idSesion +
                                        ');" class="btn btn-success btn-min-width"><i class="fa fa-check-circle"></i> Terminada</button>';
                                } else {
                                    contenido +=
                                        '<button type="button" onclick="$.MostrarPrueba(' +
                                        item.idSesion +
                                        ');" class="btn btn-info"><i class="fa fa-arrow-right"></i> Iniciar</button>';

                                }
                                contenido +=
                                    '<input type="hidden" name="estadoArea[]" value="' +
                                    item.estadoarea + '">' +
                                    '<input type="hidden" name="idArea[]" value="' +
                                    item.idarea + '"></input></div>' +
                                    '<input type="hidden" name="npreg[]" value="' +
                                    item.npreguntas + '"></input></div>' +
                                    ' </div></div>';


                            });


                        }
                    });

                    $("#Div_ListAreas").html(contenido);

                },
                actualizarTiempo:function(){
                    tiempoTranscurrido++;
                },
                MostrarPrueba: function(id) {

                    clearInterval(intervalo);
                    tiempoTranscurrido = 0;

                    intervalo = setInterval($.actualizarTiempo, 1000);

                    var form = $("#formAuxiliarPreguntas");
                    var url = form.attr("action");
                    var contenido = '';
                    var Tiempo = $("#tiempo").val();
                    var idSesion = $("#idSesi").val();
                    var idSimu = $("#idSimu").val();

                    if ($("#estaSesion").val() == "FINALIZADA") {
                        swal({
                            title: "Notificaciones Simulacro",
                            text: "La Sesión a Sido Finalizada",
                            icon: "warning",
                            button: "Aceptar",
                        });
                        return;
                    }




                    $("#idAreaSesion").remove();
                    $("#idSes").remove();
                    form.append("<input type='hidden' name='idAreaSesion' id='idAreaSesion' value='" +
                        id + "'>");
                    form.append("<input type='hidden' name='idSes' id='idSes' value='" + idSesion +
                        "'>");

                    var datos = form.serialize();

                    $("#Div_Preguntas").show();
                    $("#Div_PruebaInf").show();
                    $("#Div_Areas").hide();

                    var $wrapper = $('#DetEval');
                    $wrapper.avnSkeleton('display');

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        dataType: "json",
                        async: false,
                        success: function(respuesta) {
                            $wrapper.avnSkeleton('remove');
                            $wrapper.find('> header').append("Preguntas Área " + respuesta
                                .areaxsesion.nombre_area);

                            $("#sesion_id").val(respuesta.areaxsesion.sesion);
                            $("#area_id").val(respuesta.areaxsesion.area);
                            $("#NPreg").val(respuesta.areaxsesion.npreguntas);


                            var contenido =
                                '<form method="post" action="{{ url('/') }}/ModuloE/RespSimulacro" id="Evaluacion" class="number-tab-stepsPreg wizard-circle"><div class="col-md-12">' +
                                '<div id="wizard">';

                            var Preg = 1;
                            var ConsPre = 0;
                            var enunciado = "N/A";
                            $.each(respuesta.PregArea, function(i, item) {
                                if (item.enunciado != null) {
                                    enunciado = item.enunciado;
                                } else {
                                    enunciado = "N/A";
                                }

                                contenido += '<h2></h2>' +
                                    '         <fieldset>' +
                                    '         <div class="row p-1">' +
                                    '   <div style="width: 100%" class="bs-callout-primary callout-border-right callout-bordered callout-transparent p-1" >';
                                contenido +=
                                    '<div class="row border-bottom-blue-grey"><div class="col-md-12 pb-1"><h6>Enunciado:</h6><label id="enunciado">' +
                                    enunciado + '</label></div></div>';
                                contenido += '<div class="row pt-1" >';
                                if (respuesta.areaxsesion.area == "5") {
                                    contenido +=
                                        '<input type="hidden" id="id-pregunta' +
                                        ConsPre + '"  value="' + item.pregunta +
                                        '" />';
                                } else {
                                    contenido +=
                                        '<input type="hidden" id="id-pregunta' +
                                        ConsPre + '"  value="' + item.id + '" />';
                                }
                                contenido += '<input type="hidden" id="id-banco' +
                                    ConsPre + '"  value="' + item.banco + '" />' +
                                    '<input type="hidden" id="parte' +
                                    ConsPre + '"  value="' + item.parte + '" />' +
                                    '      <div class="col-md-12"><h4 class="primary">Pregunta ' +
                                    Preg + '</h4></div>' +

                                    '      <div class="col-md-12" id="Pregunta' +
                                    ConsPre + '">' +
                                    '           </div>' +
                                    '           </div>' +
                                    '           </div>' +
                                    '             </div>' +
                                    '        </fieldset>';
                                Preg++;
                                ConsPre++;

                            });

                            contenido += '</div></div></form>';

                            $wrapper.find('> main').append(contenido); 

                            $.CargPreg("0");
                            const sesionIni = localStorage.getItem('sesionIniciada');

                            $("#wizard").steps({
                                headerTag: "h2",
                                bodyTag: "fieldset",
                                transitionEffect: "slideLeft",
                                onFinished: function(event, currentIndex) {

                                    if (flagTimFin === "s") {
                                        mensaje =
                                            "El Tiempo de la Sesión a Finalizado";
                                        swal({
                                            title: "",
                                            text: mensaje,
                                            icon: "warning",
                                            button: "Aceptar",
                                        });
                                        return;
                                    }

                                    $.GuarPreg(currentIndex, 'Ultima');
                                    if (flagGlobal === "s") {
                                        return;
                                    }
                                },
                                onStepChanging: function(event, currentIndex,
                                    newIndex) {
                                    if (flagTimFin === "s") {
                                        mensaje =
                                            "El Tiempo de la Sesión a Finalizado";
                                        swal({
                                            title: "",
                                            text: mensaje,
                                            icon: "warning",
                                            button: "Aceptar",
                                        });
                                        return;
                                    }

                                    $.GuarPreg(currentIndex, 'next');

                                    if (flagGlobal === "s") {
                                        return;
                                    }

                                    $.CargPreg(newIndex);

                                    if (currentIndex > newIndex) {
                                        return true;
                                    }
                                    form.validate().settings.ignore =
                                        ":disabled,:hidden";
                                    return form.valid();
                                },
                            });


                            ////INICIO DE TIEMPO

                      
                            if (sesionIni == "No") {

                                mensaje = "Esta Sesión Cuenta con un Tiempo de " + Tiempo +
                                    " para ser Desarrollada. ¿Desea dar inicio a la Sesión?";
                                    swal({
                                        title: mensaje,
                                        text: "",
                                        icon: "warning",
                                        buttons: true,
                                        buttons: ["Cancelar", "Aceptar"],
                                        dangerMode: true,
                                    }).then((result) => {
                                        if (result === true) {


                                        var form = $("#formAuxiliarGuardarInicioSesion");
                                        $("#idSes").remove();
                                        $("#idSimula").remove();
                                        form.append(
                                            "<input type='hidden' name='idSes' id='idSes' value='" +
                                            idSesion + "'>");
                                        form.append(
                                            "<input type='hidden' name='idSimula' id='idSimula' value='" +
                                            idSimu + "'>");


                                        var datos = form.serialize();
                                        var url = form.attr("action");
                                        var datos = form.serialize();

                                        $.ajax({
                                            type: "POST",
                                            url: url,
                                            data: datos,
                                            dataType: "json",
                                            async: false,
                                            success: function(respuesta) {

                                            }
                                        });



                                        clearInterval();
                                        localStorage.setItem('sesionIniciada',
                                            'Si');
                                        var hora = Tiempo;

                                        parts = hora.split(':');
                                        var hor = parts[0];
                                        var min = parts[1];

                                        var milhor = parseInt(hor) * 3600000;
                                        var milmin = parseInt(min) * 60000;

                                        // Establece la fecha hasta la que estamos contando
                                        var countDownDate = milhor + milmin;

                                        var ahora = new Date().getTime();
                                        localStorage.setItem('horaInicio', ahora);


                                        countDownDate = countDownDate + ahora;
                                        var tiempoextra = 300000;
                                        var totaltiempo = countDownDate - ahora;



                                        // Actualiza la cuenta atrás cada 1 segundo.
                                        xtiempo = setInterval(function() {


                                            // Obtener la fecha y la hora de hoy
                                            var now = new Date().getTime();

                                            // Encuentra la distancia entre ahora y la fecha de la cuenta regresiva
                                            var distance = countDownDate -
                                                now;


                                            // Cálculos de tiempo para días, horas, minutos y segundos
                                            var days = Math.floor(distance /
                                                (1000 * 60 *
                                                    60 * 24));
                                            var hours = Math.floor((
                                                distance % (1000 *
                                                    60 *
                                                    60 * 24)) / (
                                                1000 * 60 * 60));
                                            var minutes = Math.floor((
                                                distance % (1000 *
                                                    60 * 60)) / (
                                                1000 * 60));
                                            var seconds = Math.floor((
                                                distance % (1000 *
                                                    60)) / 1000);

                                            var tiempoCompl = now - ahora;

                                            var por = (tiempoCompl * 100) /
                                                totaltiempo;
                                            $("#progbar_tiempo").css(
                                                "width", por + "%");


                                            // Muestra el resultado en un elemento
                                            document.getElementById(
                                                    "cont_tiempo")
                                                .innerHTML =
                                                hours + "h " + minutes +
                                                "m " + seconds +
                                                "s ";
                                            var horas = Math.floor(
                                                tiempoCompl / (1000 *
                                                    60 * 60));
                                            var minutes = Math.floor(
                                                tiempoCompl / 60000);
                                            var seconds = ((tiempoCompl %
                                                    60000) / 1000)
                                                .toFixed(0);

                                            $("#tiempoSesiom").val(horas +
                                                ":" +
                                                minutes + ":" + (
                                                    seconds < 10 ? '0' :
                                                    '') + seconds);

                                            // Si la cuenta atrás ha terminado, escribe un texto.

                                            if (flagTimExt === "n") {
                                                if (distance <
                                                    tiempoextra) {
                                                    flagTimExt = "s";
                                                    mensaje =
                                                        "La Sesión finalizara en 5 Minutos, si aún tiene preguntas por responder por favor responda y presione el botón Finalizar.";
                                                    swal({
                                                        title: "Notificación Simulacro",
                                                        text: mensaje,
                                                        icon: "warning",
                                                        button: "Aceptar",
                                                    });
                                                }
                                            }

                                            if (flagTimExt === "s") {
                                                if (distance < 0) {
                                                    flagTimFin = "s";
                                                    clearInterval(xtiempo);
                                                    document.getElementById(
                                                            "cont_tiempo")
                                                        .innerHTML =
                                                        "0h 0m 0s";
                                                    document.getElementById(
                                                            "spanTiempo")
                                                        .innerHTML =
                                                        "Tiempo Terminado";

                                                    mensaje =
                                                        "¡El tiempo se ha agotado!, La Sesion será calificada.";
                                                    swal({
                                                        title: "Notificación Simulacro",
                                                        text: mensaje,
                                                        icon: "warning",
                                                        button: "Aceptar",
                                                    });


                                                    $.GuardarSesionTiempo();

                                                    return;

                                                }
                                            }

                                        }, 1000);
                                        ////////////////////////FIN CONTADOR////////////////////////


                                    } else {
                                        $.mostAreas();
                                    }
                                });
                            } else {

                                clearInterval(xtiempo);
                                xtiempo = null;
                                var hora = Tiempo;

                                parts = hora.split(':');
                                var hor = parts[0];
                                var min = parts[1];

                                var milhor = parseInt(hor) * 3600000;
                                var milmin = parseInt(min) * 60000;

                                // Establece la fecha hasta la que estamos contando
                                var countDownDate = milhor + milmin;
                                const ahora = localStorage.getItem('horaInicio');


                                countDownDate = countDownDate + parseInt(ahora);
                                var tiempoextra = 300000;
                                var totaltiempo = countDownDate - ahora;
                                var tiempofinalizado = "n";

                                // Actualiza la cuenta atrás cada 1 segundo.
                                xtiempo = setInterval(function() {


                                    // Obtener la fecha y la hora de hoy
                                    var now = new Date().getTime();

                                    // Encuentra la distancia entre ahora y la fecha de la cuenta regresiva
                                    var distance = countDownDate -
                                        now;
                                    // Cálculos de tiempo para días, horas, minutos y segundos
                                    var days = Math.floor(distance /
                                        (1000 * 60 *
                                            60 * 24));
                                    var hours = Math.floor((
                                        distance % (1000 *
                                            60 *
                                            60 * 24)) / (
                                        1000 * 60 * 60));
                                    var minutes = Math.floor((
                                        distance % (1000 *
                                            60 * 60)) / (
                                        1000 * 60));
                                    var seconds = Math.floor((
                                        distance % (1000 *
                                            60)) / 1000);

                                    var tiempoCompl = now - ahora;

                                    var por = (tiempoCompl * 100) / totaltiempo;
                                    $("#progbar_tiempo").css("width", por + "%");


                                    // Muestra el resultado en un elemento
                                    document.getElementById(
                                            "cont_tiempo")
                                        .innerHTML =
                                        hours + "h " + minutes +
                                        "m " + seconds +
                                        "s ";
                                    var horas = Math.floor(
                                        tiempoCompl / (1000 *
                                            60 * 60));
                                    var minutes = Math.floor(tiempoCompl / 60000);
                                    var seconds = ((tiempoCompl %
                                            60000) / 1000)
                                        .toFixed(0);

                                    $("#tiempoSesiom").val(horas +
                                        ":" +
                                        minutes + ":" + (
                                            seconds < 10 ? '0' :
                                            '') + seconds);

                                    // Si la cuenta atrás ha terminado, escribe un texto.

                                    if (flagTimExt === "n") {
                                        if (distance <
                                            tiempoextra) {
                                            flagTimExt = "s";
                                            mensaje =
                                                "La Sesión finalizara en 5 Minutos, si aún tiene preguntas por responder por favor responda y presione el botón Finalizar.";
                                            swal({
                                                title: "Notificación de Sesión",
                                                text: mensaje,
                                                icon: "warning",
                                                button: "Aceptar",
                                            });
                                        }
                                    }

                                    if (flagTimExt === "s") {
                                        if (distance < 0) {
                                            flagTimFin = "s";
                                            clearInterval(xtiempo);
                                            document.getElementById(
                                                    "cont_tiempo")
                                                .innerHTML =
                                                "TIEMPO TERMINADO";
                                            mensaje =
                                                "¡El tiempo se ha agotado!, La Sesion será calificada.";
                                            swal({
                                                title: "Notificación de Sesión",
                                                text: mensaje,
                                                icon: "warning",
                                                button: "Aceptar",
                                            });
                                            localStorage.clear();
                                            tiempofinalizado = "s";

                                        }
                                    }

                                    if (tiempofinalizado == "s") {

                                        return;
                                    }

                                }, 1000);

                            }


                        }
                    });

                },
                CargPreg: function(id) {


                    var npreg = $("#NPreg").val();
                    var pregAct = $("#PregActual").val();
                    var sesion_id = $("#sesion_id").val();


                    var form = $("#formAuxiliarCargEval");
                    var Preg = $("#id-pregunta" + id).val();
                    var parte = $("#parte" + id).val();

                    var opci = "";
                    var parr = "";
                    var punt = "";

                    $("#Pregunta").remove();
                    $("#TipPregunta").remove();
                    $("#partePreg").remove();
                    form.append("<input type='hidden' name='Pregunta' id='Pregunta' value='" + Preg +
                        "'>");
                    form.append("<input type='hidden' name='partePreg' id='partePreg' value='" + parte +
                        "'>");
                    form.append("<input type='hidden' name='sesionId' id='sesionId' value='" + sesion_id +
                        "'>");

                    var url = form.attr("action");
                    var datos = form.serialize();
                    var j = 1;
                    var Pregunta = "";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: true,
                        dataType: "json",
                        success: function(respuesta) {
                            Pregunta +=
                                '<div class="pb-1"><input type="hidden"  name="PreguntaOpc" value="' +
                                respuesta.PregMult.id + '" />' + respuesta.PregMult
                                .pregunta + '</div>';
                            opciones = '';
                            var l = 1;


                            $("#CompeActual").val(respuesta.opciMultCompe);
                            $("#CompoActual").val(respuesta.opciMultCompo);

                            if (parte == "PARTE 1") {

                                const itemsOpciones = respuesta.OpciMult.split(",");
                                opciones +='<div class="skin skin-flat">';
                                opciones += '<fieldset>';
                                //custom-control-input bg-succes
                                for (let i = 0; i < itemsOpciones.length; i++) {
                                    if (respuesta.RespPregMul) {
                                        if (itemsOpciones[i] == respuesta.RespPregMul
                                            .resp_alumno) {
                                            opciones +=
                                                '<div class="d-inline-block custom-control custom-radio mr-1">';
                                            opciones +=
                                                '<input type="hidden" id="OpcionSel_' + i +
                                                '" class="OpcionSel"  name="OpcionSel[]" value="si"/>';
                                            opciones +=
                                                '<input type="hidden" id=""  name="Opciones[]" value="' +
                                                itemsOpciones[i] + '"/>';
                                            opciones +=
                                                '  <input type="radio" class="iradio_flat-green checksel" name="OpcionSel[]" onclick="$.RespMulPreg(this.id)" checked  id="' +
                                                i + '">' +
                                                '  <label  for="colorCheck2">' +
                                                itemsOpciones[i] + '</label>' +
                                                ' </div>';
                                        } else {

                                            opciones +=
                                                '<div class="d-inline-block custom-control custom-radio mr-1">';
                                            opciones +=
                                                '<input type="hidden" id="OpcionSel_' + i +
                                                '" class="OpcionSel"  name="OpcionSel[]" value="-"/>';
                                            opciones +=
                                                '<input type="hidden" id=""  name="Opciones[]" value="' +
                                                itemsOpciones[i] + '"/>';
                                            opciones +=
                                                '  <input type="radio" class="iradio_flat-green checksel" name="OpcionSel[]" onclick="$.RespMulPreg(this.id)"  id="' +
                                                i + '">' +
                                                '  <label  for="colorCheck2">' +
                                                itemsOpciones[i] + '</label>' +
                                                ' </div>';
                                        }
                                    } else {
                                        opciones +=
                                            '<div class="d-inline-block custom-control custom-radio mr-1">';
                                        opciones += '<input type="hidden" id="OpcionSel_' +
                                            i +
                                            '" class="OpcionSel"  name="OpcionSel[]" value="-"/>';
                                        opciones +=
                                            '<input type="hidden" id=""  name="Opciones[]" value="' +
                                            itemsOpciones[i] + '"/>';
                                        opciones +=
                                            '  <input type="radio" class="iradio_flat-green checksel" name="OpcionSel[]" onclick="$.RespMulPreg(this.id)"  id="' +
                                            i + '">' +
                                            '  <label  for="colorCheck2">' + itemsOpciones[
                                                i] + '</label>' +
                                            ' </div>';
                                    }


                                }
                                opciones += ' </fieldset>';
                                opciones += ' </div>';
                            } else {
                                opciones +='<div class="skin skin-flat">';
                                $.each(respuesta.OpciMult, function(k, itemo) {

                                    if ($.trim(itemo.pregunta) === $.trim(respuesta
                                            .PregMult.id)) {
                                        if (respuesta.RespPregMul) {
                                            opciones += '<fieldset>';
                                            if ($.trim(respuesta.RespPregMul
                                                    .respuesta) === $.trim(itemo
                                                    .id)) {
                                                opciones +=
                                                    '<input type="hidden" id="OpcionSel_' +
                                                    l +
                                                    '" class="OpcionSel"  name="OpcionSel[]" value="si"/>';
                                                opciones +=
                                                    ' <input type="hidden" id=""  name="Opciones[]" value="' +
                                                    itemo.id + '"/>';
                                                opciones +=
                                                    '<input onclick="$.RespMulPreg(this.id)" id="' +
                                                    l +
                                                    '" class="iradio_flat-gree checksel" checked type="radio" >';
                                            } else {
                                                opciones +=
                                                    '<input type="hidden" id="OpcionSel_' +
                                                    l +
                                                    '" class="OpcionSel"  name="OpcionSel[]" value="no"/>';
                                                opciones +=
                                                    ' <input type="hidden" id=""  name="Opciones[]" value="' +
                                                    itemo.id + '"/>';
                                                opciones +=
                                                    '<input onclick="$.RespMulPreg(this.id)" id="' +
                                                    l +
                                                    '" class="iradio_flat-gree checksel" type="radio" >';
                                            }


                                            opciones += ' <label for="input-15"> ' +
                                                itemo
                                                .opciones +
                                                '</label>' +
                                                '</fieldset>';
                                            l++;
                                        } else {
                                            opciones +=
                                                '<fieldset>';
                                            opciones +=
                                                '<input type="hidden" id="OpcionSel_' +
                                                l +
                                                '" class="OpcionSel"  name="OpcionSel[]" value="-"/>';
                                            opciones +=
                                                ' <input type="hidden" id=""  name="Opciones[]" value="' +
                                                itemo.id + '"/>';
                                            opciones +=
                                                '<input onclick="$.RespMulPreg(this.id)" id="' +
                                                l +
                                                '" class="iradio_flat-green checksel"  type="radio" >';

                                            opciones +=
                                                ' <label for="input-15"> ' +
                                                itemo
                                                .opciones +
                                                '</label>' +
                                                '</fieldset>';
                                            l++;
                                        }

                                    }

                                });
                                opciones +='</div>';
                            }

                            var compexcomp = '';


                            $("#Pregunta" + id).html(Pregunta + opciones);




                        }

                    });

                },
                GuarPreg: function(id, npreg) {

                    for (var instanceName in CKEDITOR.instances) {
                        CKEDITOR.instances[instanceName].updateElement();
                    }

                    flagGlobal = "n";
                    var form = $("#Evaluacion");
                    var url = form.attr("action");
                    var idSimu = $("#idSimu").val();
                    var IdSesion = $("#sesion_id").val();
                    var IdArea = $("#area_id").val();
                    var CantiPreg = $("#NPreg").val();
                    var token = $("#token").val();
                    var Preg = $("#id-pregunta" + id).val();
                    var tiempo = $("#tiempoSesiom").val();
                    var parte = $("#parte" + id).val();
                    var Compe = $("#CompeActual").val();
                    var Compo = $("#CompoActual").val();
                    var prgAct = id + 1;
                    var PosPreg = npreg;

                    if ($("#Tip_Usu").val() === "Estudiante") {

                        var sel = "n";
                        if ($('.checksel').is(':checked')) {
                            sel = "s";
                        }

                        if (sel === "n") {
                            flagGlobal = "s";
                            mensaje = "No ha seleccionado ninguna Opción";
                            swal({
                                title: "",
                                text: mensaje,
                                icon: "warning",
                                button: "Aceptar",
                            });
                            return;
                        }

                    }

                    $("#Pregunta").remove();
                    $("#nPregunta").remove();
                    $("#IdSesion").remove();
                    $("#IdArea").remove();
                    $("#idtoken").remove();
                    $("#idSimulacro").remove();
                    $("#prgAct").remove();
                    $("#PosPreg").remove();
                    $("#CantiPreg").remove();
                    $("#partePreg").remove();
                    $("#competencia").remove();
                    $("#componente").remove();
                    $("#TiempoxSesion").remove();

                    $("#Tiempo").remove();
                    //    clearInterval(xtiempo);
                    xtiempo = null;
                    form.append("<input type='hidden' name='Pregunta' id='Pregunta' value='" + Preg +
                        "'>");
                    form.append("<input type='hidden' name='partePreg' id='partePreg' value='" + parte +
                        "'>");
                    form.append("<input type='hidden' name='CantiPreg' id='CantiPreg' value='" +
                        CantiPreg + "'>");
                    form.append("<input type='hidden' name='PosPreg' id='PosPreg' value='" + PosPreg +
                        "'>");
                    form.append("<input type='hidden' name='idSimulacro' id='idSimulacro' value='" +
                        idSimu + "'>");
                    form.append("<input type='hidden' name='IdSesion' id='IdSesion' value='" +
                        IdSesion + "'>");
                    form.append("<input type='hidden' name='IdArea' id='IdArea' value='" + IdArea +
                        "'>");
                    form.append("<input type='hidden' name='_token' id='idtoken' value='" + token +
                        "'>");
                    form.append("<input type='hidden' name='Tiempo' id='Tiempo' value='" + tiempo +
                        "'>");
                    form.append("<input type='hidden' name='TiempoxSesion' id='TiempoxSesion' value='" + tiempoTranscurrido +
                        "'>");
                    form.append("<input type='hidden' name='prgAct' id='prgAct' value='" + prgAct +
                        "'>");
                    form.append("<input type='hidden' name='competencia' id='competencia' value='" +
                        Compe +
                        "'>");
                    form.append("<input type='hidden' name='componente' id='componente' value='" +
                        Compo +
                        "'>");

                    var datos = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        dataType: "json",
                        async: false,
                        success: function(respuesta) {
                            if (PosPreg === "Ultima") {
                                clearInterval(intervalo);
                                tiempoTranscurrido = 0;
                                $.mostrarInfSesion(respuesta);
                            } else {

                            }

                        },
                        error: function() {
                            mensaje = "La Prueba no pudo ser Guardada";
                            swal({
                                title: "",
                                text: mensaje,
                                icon: "warning",
                                button: "Aceptar",
                            });
                        }
                    });

                    $("#Pregunta" + id).html("");
                },
                RespMulPreg: function(id) {

                    $('.OpcionSel').val("no");

                    if ($('#' + id).prop('checked')) {
                        $('.checksel').prop("checked", "");
                        $('#' + id).prop("checked", "checked");
                        $('#OpcionSel_' + id).val("si");
                    }

                },
                mostAreas: function() {
                    const sesionIni = localStorage.getItem('sesionIniciada');
                    if (sesionIni == "Si") {
                        $("#Div_Areas").show();
                        $("#Div_Preguntas").hide();
                    } else {
                        $("#Div_Areas").show();
                        $("#Div_PruebaInf").hide();
                        $("#Div_Preguntas").hide();
                    }
                },
                GuardarTodoSesion: function(ori) {

                    var idSesion = $("#idSesi").val();
                    var idSimu = $("#idSimu").val();


                    if (ori == "Est") {
                        var sel = "s";
                        $("input[name='estadoArea[]']").each(function(indice, elemento) {

                            if ($(elemento).val() !== 'TERMINADA') {
                                sel = "n";
                            }
                        });


                        if (sel == "n") {
                            swal({
                                title: "Notificación Simulacro",
                                text: "Faltan Áreas por Desarrollar",
                                icon: "warning",
                                button: "Aceptar",
                            });

                        } else {
                            var form = $("#formAuxiliarGuardarSesion");
                            $("#idSes").remove();
                            $("#idSimula").remove();

                            form.append("<input type='hidden' name='idSes' id='idSes' value='" + idSesion + "'>");
                            form.append("<input type='hidden' name='idSimula' id='idSimula' value='" + idSimu + "'>");
                            var url = form.attr("action");
                            var datos = form.serialize();

                            $.ajax({
                                type: "POST",
                                url: url,
                                data: datos,
                                dataType: "json",
                                success: function(respuesta) {
                                    if (respuesta.DetaSesion) {
                                        $("#btn_guardarTodoSesion").hide();
                                        $("#Div_PruebaInf").hide();
                                        $("#Div_Areas").hide();

                                        swal({
                                            title: "Notificación Simulacro",
                                            text: "Operación Realizada Exitosamente",
                                            icon: "success",
                                            button: "Aceptar",
                                        });
                                        localStorage.clear();
                                        $.MostrarSesiones($("#simulacro_id").val());
                                    } else {
                                        $("#btn_guardarTodoSesion").show();
                                    }

                                    localStorage.removeItem('sesionIniciada');
                                    localStorage.removeItem('horaInicio');
                                }
                            });

                        }


                    } else {

                    }
                },
                mostrarInfSesion: function(respuesta) {

                    var contenido = "";
                    var ruta = $("#Ruta").data("ruta");

                    $("#Div_Areas").show();
                    $("#Div_Preguntas").hide();

                    $("#num_area").html(respuesta.SesAre.length);
                    $("#num_preg").html(respuesta.Sesion.num_preguntas);
                    $("#tiempo_sesion").html(respuesta.Sesion.tiempo_sesion + ":00");
                    $("#tiempo").val(respuesta.Sesion.tiempo_sesion);

                    $.each(respuesta.SesAre, function(i, item) {var PreAct = "";

                var pregContestada = "";
                        if (item.resp_preguntas == null) {
                            pregContestada = "0";
                        } else {
                            pregContestada = item.resp_preguntas;

                        }


                    contenido +=
                        '<div data-aos="zoom-out" class="col-xl-4 col-md-6 col-12"><div class="col-md-12 widget-area notepad">' +
                        ' <div class="team_img">' +
                        '  <a href="#">' +
                        '   <img src="' + ruta + 'images/Img_ModuloE/' +
                        item.imagen +
                        '" class="rounded-circle img-fluid" alt="">' +
                        '  </a>' +
                        ' <a href="#" style="font-size:24px;"><i class="fa fa-question"> ' +
                            pregContestada + '/' + item.npreguntas + '</i></a>' +
                        ' </div>' +
                        '<div class="team-content">' +
                        '<a href="#">' +
                        '<h5 class="title">' + item.nombre_area +
                        '</h5>' +
                        '   </a>'
                    if (item.estadoarea == "EN PROCESO") {
                        contenido +=
                            '<button type="button" onclick="$.MostrarPrueba(' +
                            item.idSesion +
                            ');" class="btn btn-warning"><i class="fa fa-info-circle"></i> En Proceso</button>';
                    } else if (item.estadoarea == "TERMINADA") {
                        contenido +=
                            '<button type="button" onclick="$.MostrarPrueba(' +
                            item.idSesion +
                            ');" class="btn btn-success btn-min-width"><i class="fa fa-check-circle"></i> Terminada</button>';
                    } else {
                        contenido +=
                            '<button type="button" onclick="$.MostrarPrueba(' +
                            item.idSesion +
                            ');" class="btn btn-info"><i class="fa fa-arrow-right"></i> Iniciar</button>';

                    }
                    contenido +=
                        '<input type="hidden" name="estadoArea[]" value="' +
                        item.estadoarea + '">' +
                        '<input type="hidden" name="idArea[]" value="' +
                        item.idarea + '"></input></div>' +
                        '<input type="hidden" name="npreg[]" value="' +
                        item.npreguntas + '"></input></div>' +
                        ' </div></div>';


                    });

                    $("#Div_ListAreas").html(contenido);

                },
            });

            $.MostrarSimulacros();


        });
    </script>
@endsection
