@extends('Plantilla.Principal')
@section('title', 'Laboratorios')
@section('Contenido')
    <div id="imgpre" class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="jumbo-heading" data-aos="fade-down">
                <h1 style="font-size: 30px;">LABORATORIOS</h1>
            </div>
        </div>
        <!-- /container -->
    </div>
    <input type="hidden" class="form-control" id="RutContDid"
        data-ruta="{{ Session::get('URL') }}/app-assets/Contenido_Laboratorio" />
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

    <input type="hidden" class="form-control" id="Tip_Usu" value="{{ Auth::user()->tipo_usuario }}" />
    <input type="hidden" class="form-control" id="Ruta" value="{{ url('/') }}/" />
    <input type="hidden" class="form-control" id="tiempEvaluacion" value="" />
    <input type="hidden" class="form-control" id="RutEvalDid"
        data-ruta="{{ Session::get('URL') }}/app-assets/Evaluacion_PregDidact" />
    <input type="hidden" class="form-control" id="RutaUrl" data-ruta="{{ Session::get('URL') }}" />
    <input type="hidden" class="form-control" id="RutEvalTaller" value="{{ url('/') }}/" />
    <input type="hidden" class="form-control" id="Id_Doce" value="{{ Session::get('DOCENTE') }}" />
    <input type="hidden" data-id='id-dat' id="Respdattaller"
        data-ruta="{{ asset('/app-assets/Archivos_EvalTaller_Resp') }}" />
    <input type="hidden" class="form-control" name="CargArchi" id="CargArchi" value="" />

    <div class="container block-padding" style="padding-top: 40px;">
        <!-- row starts -->
        <div class="row">
            <div class="container" id="ListLab">
                <div class="section-heading text-center">
                    <p class="subtitle">--- Listado de Laboratorios ---</p>
                </div>

                @php
                    $ClaseCom = ['alert-primary', 'alert-secondary', 'alert-success', 'alert-danger', 'alert-warning', 'alert-info', 'alert-light', 'alert-dark'];
                    $j = 1;
                @endphp

                @foreach ($DesLabo as $Lab)
                    @php
                        $color = $ClaseCom[array_rand($ClaseCom)];
                    @endphp
                    <div class="alert {{ $color }} hvr-grow-shadow"
                        onclick="$.MostLaboratorios('{{ $Lab->id }}')" ; style="cursor: pointer; width: 100%;"
                        role="alert"><b>
                            {{ $Lab->des_unidad }}
                            <label style='color: red;'>({{ $Lab->nlab }})</label>
                        </b> </div>
                    @php
                        $j++;
                    @endphp
                @endforeach
            </div>
            <div class="container" id="ListLabUnid" style="display: none;">
                <div class="section-heading text-center">
                    <p class="subtitle" id="TitLabo">--- Listado de Laboratorios ---</p>
                </div>
                <div id="contenedor">

                </div>


            </div>

            <div class="container" id="ContLaboratorio" style="display: none;">
                <div class="section-heading text-center">
                    <p class="subtitle" id="TitDetLabo">--- Listado de Laboratorios ---</p>
                </div>
                <div id="DetLabo">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab"
                                aria-selected="true"><i class="flaticon-classroom"></i>Fundamento Teórico</a>
                            <a class="nav-item nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab"
                                aria-selected="false"><i class="flaticon-pen"></i>Materiales</a>
                            <a class="nav-item nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab"
                                aria-selected="false"><i class="flaticon-teacher"></i>Procedimientos</a>
                            <a class="nav-item nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab"
                                aria-selected="false"><i class="flaticon-learning-1"></i>Producción</a>
                        </div>
                    </nav>
                    <!-- tab-content -->
                    <div class="tab-content block-padding" id="nav-tabContent">
                        <div class="tab-pane  fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                            <!-- row -->
                            <div class="row">
                                <!--divider -->
                                <div id="fund_teorico" style="padding-top:15px;"></div>
                            </div>
                            <!-- row -->
                        </div>
                        <!-- ./Tab-pane -->
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                            <!-- row -->
                            <div class="row">
                                <div id="materiales" style="padding-top:15px;"></div>
                            </div>
                            <!-- /row -->
                        </div>
                        <!-- ./Tab-pane -->
                        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                            <!-- row -->
                            <div class="row">
                                <div id="DivProcedimientos" style="padding-top:15px; width: 100%;"></div>
                            </div>
                            <!-- /row -->
                        </div>
                        <!-- ./Tab-pane -->
                        <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                            <!-- row -->
                            <div class="row">
                                <div id="DivProduccion" style="padding-top:15px;width: 100%;"></div>
                                <div class="list-group" id="Div_DetEval" style="display: none;">
                                    <input type="hidden" class="form-control" id="IdEval" value="" />
                                    <input type="hidden" class="form-control" id="Id_PregEns" value="" />
                                    <input type="hidden" class="form-control" id="TipEva" value="" />
                                    <div class="col-md-12">
                                        <div class="row">
                                            <!-- contact-info-->
                                            <div class="contact-info col-lg-12">
                                                <!-- contact-info-->
                                                <h3 class="mb-2" id="Tit_Eval"></h3>
                                                <p class="h7" id="titu_Eva">Pregunta</p>
                                                <div id="Enunaciado"></div>

                                                <div id="EvalPreguntas">

                                                </div>

                                                <div id="DetEvalFin">

                                                </div>

                                                <button type="button" onclick="$.MostListEval();" id="Btn_Produc"
                                                    class="btn-margin btn btn-quaternary ml-1"><i
                                                        class="fa fa-angle-double-left"></i>
                                                    Atras</button>

                                                <!-- /contact)form-->
                                            </div>
                                            <!-- /contact-info-->
                                            <div class="col-lg-12">
                                                <!-- contact info boxes start-->
                                                <div class="contact-info res-margin">
                                                    <div class="row res-margin mt-5 res-margin">
                                                        <div class="col-lg-4 mt-5 ">
                                                            <div class="contact-icon bg-secondary pattern2 text-light">
                                                                <!---icon-->
                                                                <i class="fa fa-clock top-icon"></i>
                                                                <!-- contact-icon info-->
                                                                <div class="contact-icon-info">
                                                                    <h5>Tiempo de Evaluación</h5>
                                                                    <p style="font-size: 20px;font-weight: bold;"
                                                                        id='cuenta'>---</p>
                                                                </div>
                                                            </div>
                                                            <!-- /contact-icon-->
                                                        </div>
                                                        <div class="col-lg-4 mt-5 ">
                                                            <div class="contact-icon bg-secondary pattern2 text-light">
                                                                <!---icon-->
                                                                <i class="fa fa-pencil-alt top-icon"></i>
                                                                <!-- contact-icon info-->
                                                                <div class="contact-icon-info">
                                                                    <h5>Intentos Permitidos</h5>
                                                                    <p style="font-size: 20px;font-weight: bold;"
                                                                        id='label_IntPerm'>2</p>
                                                                </div>
                                                            </div>
                                                            <!-- /contact-icon-->
                                                        </div>
                                                        <!-- /col-lg-->
                                                        <div class="col-lg-4 mt-5 res-margin ">
                                                            <div class="contact-icon bg-secondary pattern2 text-light">
                                                                <!---icon-->
                                                                <i class="fa fa-pencil-alt top-icon"></i>
                                                                <!-- contact-icon info-->
                                                                <div class="contact-icon-info">
                                                                    <h5>Intentos Realizados</h5>
                                                                    <p style="font-size: 20px;font-weight: bold;"
                                                                        id='label_IntReal'>3</p>
                                                                </div>
                                                            </div>
                                                            <!-- /contact-icon-->
                                                        </div>
                                                        <!-- /col-lg -->

                                                        <!-- /col-lg-->
                                                    </div>
                                                    <!-- /row -->
                                                </div>
                                                <!-- /contact-info-->
                                            </div>
                                            <!-- /col-lg-->
                                        </div>
                                        <!-- /row-->
                                        <!-- map-->

                                        <!-- /map-->
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                        </div>
                        <!-- ./Tab-pane -->
                    </div>
                </div>


            </div>

            <div class="modal-footer">
                <button type="button" style="display:none;" id="btn_atrasUnid" onclick="$.mostLisUnidLab();"
                    class="btn btn-primary btn-sm"><i class="fa fa-angle-double-left"></i> Atras</button>
                <button type="button" style="display:none;" id="btn_atrasLabo" onclick="$.mostListLabo();"
                    class="btn btn-primary btn-sm"><i class="fa fa-angle-double-left"></i> Atras</button>
            </div>

        </div>

    </div>

    {!! Form::open(['url' => '/Contenido/MostLaboratorios', 'id' => 'formLabo']) !!}
    {!! Form::close() !!}

    {!! Form::open(['url' => '/Contenido/MostDetLaboratorios', 'id' => 'formLaboDet']) !!}
    {!! Form::close() !!}

    {!! Form::open(['url' => '/Contenido/ContenidoEva', 'id' => 'formContenidoEva']) !!}
    {!! Form::close() !!}

    {!! Form::open(['url' => '/Asignaturas/consulPregAlumno', 'id' => 'formAuxiliarCargEval']) !!}
    {!! Form::close() !!}

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#Men_Tablero").removeClass("nav-item active");
            $("#Men_Laboratorio").addClass("nav-item active");

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

            var flagGlobal = "n";
            var flagTimExt = "n";
            var flagTimFin = "n";
            var flagIntent = "ok"

            var imageUrl = "img/jumbotronLab.jpg";
            $(".jumbotron").css("background", "url(" + $("#Ruta").val() + imageUrl + ")");
            $(".jumbotron").css("background-repeat", "no-repeat");
            $(".jumbotron").css("background-attachment", "fixed");
            $(".jumbotron").css("background-size", "contain");
            $(".jumbotron").css("margin-bottom", "0px");
            $(".jumbotron").css("background-position", "center top");
            $.extend({
                MostLaboratorios: function(id) {
                    $("#ListLabUnid").show();
                    $("#btn_atrasUnid").show();
                    $("#ListLab").hide();
                    var form = $("#formLabo");
                    $("#idUnidad").remove();
                    form.append("<input type='hidden' name='id' id='idLabo' value='" + id + "'>");
                    var url = form.attr("action");
                    var datos = form.serialize();
                    var Tip_Usu = $("#Tip_Usu").val();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        dataType: "json",
                        success: function(respuesta) {
                            TotalTemas = 0;
                            var color = "alert-primary";
                            var contenido = "";
                            $("#TitLabo").html("");
                            $("#TitLabo").html("--- " + respuesta.TitUnidad.des_unidad +
                                " ---");

                            $.each(respuesta.Laboratorios, function(i, item) {
                                contenido +=
                                    '<div class="alert alert-info hvr-grow-shadow" onclick="$.MostConteLab(' +
                                    item.id +
                                    ')" style="cursor: pointer; width: 100%;" role="alert"><b>' +
                                    item.titulo + '</b></div>';

                            });

                            $("#contenedor").html(contenido);
                        },
                        error: function() {
                            swal(
                                'Error!',
                                'Ocurrio un error...',
                                'error'
                            );
                        }
                    });
                },
                MostConteLab: function(id) {
                    $("#ContLaboratorio").show();
                    $("#ListLabUnid").hide();
                    $("#btn_atrasUnid").hide();
                    $("#btn_atrasLabo").show();

                    $("#DivProcedimientos").html("");
                    var form = $("#formLaboDet");
                    $("#idLabo").remove();
                    form.append("<input type='hidden' name='idLabo' id='idLabo' value='" + id + "'>");
                    var url = form.attr("action");
                    var datos = form.serialize();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        dataType: "json",
                        success: function(respuesta) {
                            $("#TitDetLabo").html(respuesta.Laboratorios.titulo);
                            ////CARGAR FUNDAMENTO TEORICO
                            $("#fund_teorico").html(respuesta.Laboratorios.fund_teorico);
                            /////CARGAR MATERIALES
                            $("#materiales").html(respuesta.Laboratorios.materiales);
                            /////CARGAR PROCEDIMIENTOS
                            var Procesos = "";
                            var j = 1;
                            $.each(respuesta.ProcLabo, function(i, item) {

                                Procesos = '<div id="proc' + j +
                                    '" style="padding-bottom: 15px;">' +
                                    ' <div class="bs-callout-primary callout-border-right callout-bordered callout-transparent p-1">' +
                                    ' <h6 class="primary">Procedimiento ' + j +
                                    '</h6>' +
                                    '<div class="row match-height">' +
                                    '    <div class="col-md-7 col-sm-12">' +
                                    '    <div class="card border-primary bg-transparent" style="height: 314.017px;overflow: auto">' +
                                    '      <div class="card-content">' +
                                    item.procedimiento +
                                    '</div>' +
                                    '    </div>' +
                                    '  </div>' +
                                    '<div class="col-md-5 col-sm-12">' +
                                    '   <div class="card border-blue bg-transparent" style="height: 309.333px;">' +
                                    ' <div class="card">' +
                                    '    <div class="card-content">' +
                                    '       <label class="card-title">Video Procedimiento.</label>' +
                                    '       <div  id="cont-video' + j + '">' +
                                    '<video id="datruta' + j +
                                    '" height="100%" style="width: 100%"  controls >' +
                                    '<source src="" id="sour_video' + j +
                                    '" type="video/mp4">' +
                                    '</video></div>' +
                                    '      </div>' +
                                    '          </div>' +
                                    '            </div>' +
                                    ' </div>' +
                                    ' </div>' +
                                    ' </div>';

                                Procesos +=
                                    '   </div>' +
                                    '</div>';
                                $("#DivProcedimientos").append(Procesos);

                                if (item.vide_proced !== "") {
                                    jQuery('#sour_video' + j).attr('src', $(
                                            '#RutContDid')
                                        .data("ruta") + "/" + item.vide_proced);
                                } else {
                                    $("#cont-video" + j).html(
                                        "<img src='' style='width:250px; height:200px;' id='embed_arch" +
                                        j +
                                        "' alt='Este procedimiento no contiene video.'>"
                                    );
                                    jQuery('#embed_arch' + j).attr('src', $(
                                        '#RutImg').data("ruta"));
                                }


                                j++;

                            });

                            ////CARGAR PRODUCCIÓN
                            var ContenidoEval = "";
                            $.each(respuesta.EvalLabo, function(i, item) {
                                ContenidoEval +=
                                    '<div class="alert alert-info hvr-grow-shadow" onclick="$.MostEval(' +
                                    item.id +
                                    ')" style="cursor: pointer; width: 100%;" role="alert"><b>' +
                                    item.titulo + '</b></div>';
                                j++;
                            });

                            $("#DivProduccion").html(ContenidoEval);


                        }
                    });
                },
                mostLisUnidLab: function() {
                    $("#ListLab").show();
                    $("#ListLabUnid").hide();
                    $("#btn_atrasUnid").hide();
                },
                mostListLabo: function() {
                    $("#ContLaboratorio").hide();
                    $("#ListLabUnid").show();
                    $("#btn_atrasUnid").show();
                    $("#btn_atrasLabo").hide();
                },
                MostEval: function(id) {
                    var form = $("#formContenidoEva");
                    $("#idAuxiliar").remove();
                    form.append("<input type='hidden' name='id' id='idAuxiliar' value='" + id + "'>");
                    var url = form.attr("action");
                    var datos = form.serialize();
                    var contenido = "";
                    var Enunciado = "";
                    var videoDida = "";
                    var Parrafo = "";
                    var NomVidEval = "";
                    $("#DivProduccion").hide();
                    $("#Enunaciado").html("");
                    $("#titu_Eva").show();
                    $("#Enunaciado").show();
                    $("#Div_DetEval").show();
                    $("#DetEvalFin").hide();
                    $("#EvalPreguntas").show();
                    $("#btn_eval").hide();


                    $.ajax({
                        type: "post",
                        url: url,
                        data: datos,
                        success: function(respuesta) {

                            $("#titu_Eva").html(respuesta.titulo);
                            var n = 1;
                            TipEval = respuesta.tipeval;
                            Tiempo = respuesta.tiempo;
                            HabTie = respuesta.hab_tiempo;

                            var Enun = respuesta.enunciado;
                            if (Enun === null) {
                                Enun = "";
                            }

                            Enunciado += Enun;
                            $("#IdEval").val(id);
                            $("#TipEva").val(respuesta.tipeval);
                            $("#Enunaciado").append(Enunciado);

                            if (respuesta.VideoEval !== "no") {
                                videoDida += '<div class="accordion">' +
                                    ' <div class="card">' +
                                    '    <div class="card-header">' +
                                    '        <a class="card-link collapsed" onclick="$.CerraViEval();" data-toggle="collapse" href="#collapseOne" aria-expanded="false">' +
                                    '            Ver Contenido Didactico' +
                                    '        </a>' +
                                    '    </div>' +
                                    '    <div id="collapseOne" class="collapse" data-parent=".accordion" style="">' +
                                    '        <div class="card-body">' +
                                    '          <video id="datruta"  data-ruta="{{ Session::get('URL') }}/app-assets/Evaluacion_PregDidact" width="100%" height="360" controls="controls" title="Video title">' +
                                    ' </video>' +
                                    '       </div>' +
                                    '   </div>' +
                                    '  </div>' +
                                    ' </div>';
                                $("#Enunaciado").append(videoDida);

                                $("#datruta").html(
                                    '<source src="" id="sour_video" type="video/mp4">'
                                );
                                jQuery('#sour_video').attr('src', $('#datruta').data(
                                    "ruta") + "/" + respuesta.VideoEval);

                            }

                            var int_real = respuesta.int_realizados;
                            var int_perm = respuesta.int_perm;

                            $("#label_IntPerm").html(int_perm);
                            $("#label_IntReal").html(int_real);
                            if (respuesta.perfil === "Estudiante") {
                                if (parseInt(respuesta.int_realizados) >= parseInt(respuesta
                                        .int_perm)) {
                                    flagIntent = "fail";
                                } else {
                                    flagIntent = "ok";
                                }
                            } else {
                                flagIntent = "ok";
                            }



                            var contenido =
                                '<form method="post" action="{{ url('/') }}/Guardar/RespEvaluaciones" id="Evaluacion" class="number-tab-stepsPreg wizard-circle"><div class="col-md-12">' +
                                '<div id="wizard">';

                            var Preg = 1;
                            var ConsPre = 0;

                            $.each(respuesta.PregEval, function(i, item) {
                                contenido += '<h2></h2>' +
                                    '<fieldset>' +
                                    ' <div class="row p-1">' +
                                    '   <div  style="width: 100%" class="bs-callout-primary callout-border-right callout-bordered callout-transparent p-1" >' +
                                    '   <div class="row" >' +
                                    '<input type="hidden" id="id-pregunta' +
                                    ConsPre + '"  value="' + item.idpreg + '" />' +
                                    '<input type="hidden" id="tip-pregunta' +
                                    ConsPre + '"  value="' + item.tipo + '" />' +
                                    '      <div class="col-md-9"><h5 class="primary">Pregunta ' +
                                    Preg + '</h5></div>' +
                                    '      <div class="col-md-3"><span class=" float-right"><i class="fa fa-circle" style="color: #1ECD60"></i id="Puntaje' +
                                    ConsPre + '"> 10 Puntos</span></div>' +
                                    '      <div class="col-md-12" id="Pregunta' +
                                    ConsPre + '">' +
                                    '           </div>    ' +
                                    '           </div>    ' +
                                    '           </div>    ' +
                                    '             </div>' +
                                    '</fieldset>';
                                Preg++;
                                ConsPre++;
                            });

                            '</div></div></form>';

                            $("#EvalPreguntas").html(contenido);

                            $.CargPreg("0");

                            $("#wizard").steps({
                                headerTag: "h2",
                                bodyTag: "fieldset",
                                transitionEffect: "slideLeft",
                                onFinished: function(event, currentIndex) {
                                    if (flagTimFin === "s") {
                                        mensaje =
                                            "El Tiempo de Evaluación a Finalizado";
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
                                    // Allways allow previous action even if the current form is not valid!
                                    if (flagTimFin === "s") {
                                        mensaje =
                                            "El Tiempo de Evaluación a Finalizado";
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

                            //////MOSTRAR CONTADOR DE EVALUACIÓN//////////
                            if (HabTie === "SI") {
                                mensaje = "Esta Evaluacion Cuenta con un Tiempo de " +
                                    Tiempo +
                                    " para ser Desarrollada. ¿Desea Realizar Esta Evaluación?";
                                swal({
                                    title: mensaje,
                                    text: "",
                                    icon: "warning",
                                    buttons: true,
                                    buttons: ["Cancelar", "Aceptar"],
                                    dangerMode: true,
                                }).then((result) => {
                                    if (result === true) {

                                        $("#btn_eval").show();
                                        $("#titu_Eva").show();
                                        $("#titu_temaEva").hide();
                                        $("#Div_ListEva").hide();
                                        $("#Div_DetEval").show();

                                        if (HabTie == "SI") {
                                            var hora = Tiempo;

                                            parts = hora.split(':');
                                            var hora = Tiempo;
                                            parts = hora.split(':');
                                            var hor = parts[0];
                                            var min = parts[1];

                                            var milhor = parseInt(hor) * 3600000;
                                            var milmin = parseInt(min) * 60000;


                                            // Establece la fecha hasta la que estamos contando
                                            var countDownDate = milhor + milmin;

                                            var ahora = new Date().getTime();
                                            countDownDate = countDownDate + ahora;
                                            var tiempoextra = 300000;

                                            // Actualiza la cuenta atrás cada 1 segundo.
                                            var x = setInterval(function() {

                                                var oElem = document
                                                    .getElementById(
                                                        'cuenta');


                                                // Obtener la fecha y la hora de hoy
                                                var now = new Date()
                                                    .getTime();

                                                // Encuentra la distancia entre ahora y la fecha de la cuenta regresiva
                                                var distance =
                                                    countDownDate - now;

                                                // Cálculos de tiempo para días, horas, minutos y segundos
                                                var days = Math.floor(
                                                    distance / (1000 *
                                                        60 *
                                                        60 * 24));
                                                var hours = Math.floor((
                                                        distance % (
                                                            1000 * 60 *
                                                            60 * 24)) /
                                                    (1000 * 60 * 60));
                                                var minutes = Math.floor((
                                                        distance % (
                                                            1000 *
                                                            60 * 60)) /
                                                    (1000 * 60));
                                                var seconds = Math.floor((
                                                    distance % (
                                                        1000 *
                                                        60)) / 1000);

                                                var tiempoCompl = now -
                                                    ahora;


                                                // Muestra el resultado en un elemento
                                                document.getElementById(
                                                        "cuenta")
                                                    .innerHTML =
                                                    hours + "h " + minutes +
                                                    "m " + seconds +
                                                    "s ";
                                                var horas = Math.floor(
                                                    tiempoCompl / (
                                                        1000 *
                                                        60 * 60));
                                                var minutes = Math.floor(
                                                    tiempoCompl / 60000);
                                                var seconds = ((
                                                        tiempoCompl %
                                                        60000) / 1000)
                                                    .toFixed(0);

                                                $("#tiempEvaluacion").val(
                                                    horas + ":" +
                                                    minutes + ":" + (
                                                        seconds < 10 ?
                                                        '0' :
                                                        '') + seconds);

                                                // Si la cuenta atrás ha terminado, escribe un texto.

                                                if (flagTimExt === "n") {
                                                    if (distance <
                                                        tiempoextra) {
                                                        flagTimExt = "s";
                                                        mensaje =
                                                            "La Evaluación finalizara en 5 Minutos, si aún tiene preguntas por responder por favor responda y presione el botón Finalizar.";
                                                        swal({
                                                            title: "Notificación de Evaluación",
                                                            text: mensaje,
                                                            icon: "warning",
                                                            button: "Aceptar",
                                                        });
                                                    }
                                                }

                                                if (flagTimExt === "s") {
                                                    if (distance < 0) {
                                                        flagTimFin = "s";
                                                        clearInterval(x);
                                                        document
                                                            .getElementById(
                                                                "cuenta")
                                                            .innerHTML =
                                                            "TIEMPO DE EVALUACIÓN TERMINADO";

                                                        mensaje =
                                                            "La Evaluación ha finalizado, si no logro terminar informe al Docente encargado.";
                                                        swal({
                                                            title: "Notificación de Evaluación",
                                                            text: mensaje,
                                                            icon: "warning",
                                                            button: "Aceptar",
                                                        });

                                                    }
                                                }

                                            }, 1000);
                                        }
                                        ////////////////////////FIN CONTADOR////////////////////////


                                    } else {
                                        $.atrasDetEval();
                                    }
                                });
                            } else {
                                $("#Div_ListEva").hide();
                                $("#Div_DetEval").show();

                            }


                        }

                    });
                },
                atrasDetEval: function() {

                    btnAtras.setAttribute("onclick", "$.atrasEval()");
                    $("#listPracticas").show();
                    $("#Div_DetEval").hide();
                    clearInterval(xtiempo);

                },
                hab_ediContComplete: function() {
                    CKEDITOR.replace('RespPregComplete', {
                        width: '100%',
                        height: 100
                    });
                },
                RespMulPreg: function(id, j) {

                    $('.OpcionSel_' + j).val("no");
                    if (j > 9) {
                        var nid = id.substr(-3);
                    } else {
                        var nid = id.substr(-2);
                    }


                    if ($('#' + id).prop('checked')) {
                        $('#OpcionSel_' + nid).val("si");
                    }
                },
                CargPreg: function(id) {

                    var form = $("#formAuxiliarCargEval");
                    var Preg = $("#id-pregunta" + id).val();
                    var tipo = $("#tip-pregunta" + id).val();

                    var opci = "";
                    var parr = "";
                    var punt = "";

                    $("#Pregunta").remove();
                    $("#TipPregunta").remove();
                    form.append("<input type='hidden' name='Pregunta' id='Pregunta' value='" +
                        Preg + "'>");
                    form.append(
                        "<input type='hidden' name='TipPregunta' id='TipPregunta' value='" + tipo +
                        "'>"
                    );
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
                            if (tipo === "PREGENSAY") {
                                $("#Puntaje" + id).html(respuesta.PregEnsayo.puntaje +
                                    " Puntos");

                                Pregunta += respuesta.PregEnsayo.pregunta;
                                Pregunta += '<div class="col-xl-12 col-lg-6 col-md-12">' +
                                    '   <label for="placeTextarea">Respuesta:</label>' +
                                    ' <textarea cols="80" id="RespPregEns" name="RespPregEns"' +
                                    ' rows="3"></textarea>' +
                                    ' </div>';
                                $("#Pregunta" + id).html(Pregunta);
                                $.hab_ediContPregEnsayo();
                                if (respuesta.RespPregEnsayo) {
                                    $('#RespPregEns').val(respuesta.RespPregEnsayo
                                        .respuesta);
                                }
                            } else if (tipo === "COMPLETE") {
                                $("#Puntaje" + id).html(respuesta.PregComple.puntaje +
                                    " Puntos");
                                Pregunta += '<div class="col-xl-12 col-lg-6 col-md-12">' +
                                    '   <label for="placeTextarea">Complete el Parrafo con las siguientes Opciones:</label>' +
                                    '<p>' + respuesta.PregComple.opciones + '</p>' +
                                    ' <textarea cols="80" id="RespPregComplete" name="RespPregComplete"' +
                                    ' rows="3"></textarea>' +
                                    ' </div>';
                                $("#Pregunta" + id).html(Pregunta);
                                $.hab_ediContComplete();
                                $('#RespPregComplete').val(respuesta.PregComple.parrafo);
                                if (respuesta.RespPregComple) {
                                    $('#RespPregComplete').val(respuesta.RespPregComple
                                        .respuesta);
                                }

                            } else if (tipo === "OPCMULT") {
                                $("#Puntaje" + id).html(respuesta.PregMult.puntuacion +
                                    " Puntos");
                                Pregunta +=
                                    '<div class="pb-1"><input type="hidden"  name="PreguntaOpc" value="' +
                                    respuesta.PregMult.id + '" />' + respuesta.PregMult
                                    .pregunta + '</div>';
                                opciones = '';
                                var l = 1;
                                $.each(respuesta.OpciMult,
                                    function(k, itemo) {

                                        if ($.trim(itemo
                                                .pregunta
                                            ) === $
                                            .trim(respuesta.PregMult.id)) {
                                            if (respuesta.RespPregMul) {
                                                opciones +=
                                                    '<fieldset>';
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
                                                        '" class="checksel" checked type="checkbox" >';
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
                                                        '" class="checksel" type="checkbox" >';
                                                }


                                                opciones +=
                                                    ' <label for="input-15"> ' +
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
                                                    '" class="checksel" type="checkbox" >';

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

                                $("#Pregunta" + id).html(Pregunta + opciones);


                            } else if (tipo === "VERFAL") {
                                $("#Puntaje" + id).html(respuesta.PregVerFal.puntaje +
                                    " Puntos");


                                Pregunta += respuesta.PregVerFal.pregunta;
                                var Opc =
                                    '<div class="form-group row">' +
                                    '<div class="col-md-12">' +
                                    '    <fieldset >' +
                                    '        <div class="input-group">';

                                Opc +=
                                    '<input name="radpregVerFal[]" id="RadVer" value="si"  type="radio">';

                                Opc +=
                                    ' <div class="input-group-append" style="margin-left:5px;">' +
                                    '            <span  id="basic-addon2">Verdadero</span>' +
                                    '          </div>' +
                                    '        </div>' +
                                    '      </fieldset>' +
                                    '</div>' +
                                    '<div  class="col-md-12">' +
                                    '    <fieldset >' +
                                    '        <div class="input-group">';
                                Opc +=
                                    ' <input name="radpregVerFal[]" id="RadFal"  value="no"  type="radio">';
                                Opc +=
                                    '<div class="input-group-append" style="margin-left:5px;">' +
                                    '            <span  id="basic-addon2">Falso</span>' +
                                    '          </div>' +
                                    '        </div>' +
                                    '      </fieldset>' +
                                    '</div>' +
                                    '            </div>';


                                $("#Pregunta" + id).html(Pregunta + Opc);

                                if (respuesta.RespPregVerFal) {
                                    if (respuesta.RespPregVerFal.respuesta_alumno ===
                                        "si") {
                                        $('#RadVer').prop("checked", "checked");
                                    } else {
                                        $('#RadFal').prop("checked", "checked");
                                    }
                                }
                            } else if (tipo === "RELACIONE") {
                                $("#Puntaje" + id).html(respuesta.PregRelacione.puntaje +
                                    " Puntos");
                                var enun = respuesta.PregRelacione.enunciado;
                                if (enun === null) {
                                    enun = "";
                                }
                                Pregunta += '<div class="row"><div class="col-md-12"><p>' +
                                    enun + '</p></div></div><div class="row">';
                                var j = 1;
                                var selectPreg = '';
                                var cons = 1;

                                $.each(respuesta.PregRelIndi, function(k, item) {

                                    selectPreg = '<div class="contenedor' + cons +
                                        '">' +
                                        '    <div class="selectbox">' +
                                        '        <div class="select" id="select' +
                                        cons + '">' +
                                        '            <div class="contenido-select">' +
                                        '               <h5 class="titulo">Seleccione Una Respuesta</h5>' +
                                        '            </div>' +
                                        '           <i class="fa fa-angle-down"></i>' +
                                        '       </div>' +
                                        '<div class="opciones" id="opciones' +
                                        cons + '">';
                                    var j = 1;
                                    $.each(respuesta.PregRelResp, function(k,
                                        itemr) {
                                        selectPreg +=
                                            ' <a onclick="$.selopc(this.id,' +
                                            cons + ')" id="' + j +
                                            '" data-id="' + itemr.id +
                                            '" class="opcion">' +
                                            '<div class="contenido-opcion">' +
                                            itemr.respuesta +
                                            '     </div>' +
                                            '   </a>';
                                        j++;
                                    });
                                    selectPreg += '</div>' +
                                        '   </div>' +
                                        '    <input type="hidden"  name="RespSelect[]" id="RespSelect' +
                                        cons + '" value="">' +
                                        '    <input type="hidden"  name="RespPreg[]" value="' +
                                        item.id + '">' +
                                        '    <input type="hidden"  name="ConsPreg[]" id="ConsPreg' +
                                        cons + '" value="">' +
                                        ' </div>';
                                    Pregunta +=
                                        '<div class="col-md-6 pb-2" style="display: flex;align-items: center;justify-content: center;"> <div  id="DivInd' +
                                        j + '">' + item.definicion + '</div></div>';
                                    Pregunta +=
                                        '<div class="col-md-6 pb-2"> <div id="DivRes' +
                                        j + '">' + selectPreg + '</div></div>';
                                    cons++;
                                });

                                Pregunta += '</div>';

                                $("#Pregunta" + id).html(Pregunta);
                                cons = 1;
                                $.each(respuesta.PregRelIndi, function(k, item) {
                                    const select = document.querySelector(
                                        '#select' + cons);
                                    const opciones = document.querySelector(
                                        '#opciones' + cons);
                                    const contenidoSelect = document.querySelector(
                                        '#select' + cons + ' .contenido-select');
                                    const hiddenInput = document.querySelector(
                                        '#inputSelect' + cons);

                                    document.querySelectorAll('#opciones' + cons +
                                        ' > .opcion').forEach((opcion) => {
                                        opcion.addEventListener('click', (
                                            e) => {
                                            e.preventDefault();
                                            contenidoSelect
                                                .innerHTML = e
                                                .currentTarget
                                                .innerHTML;
                                            select.classList.toggle(
                                                'active');
                                            opciones.classList
                                                .toggle('active');
                                        });
                                    });

                                    select.addEventListener('click', () => {
                                        select.classList.toggle('active');
                                        opciones.classList.toggle('active');
                                    });
                                    cons++;

                                });

                                cons = 1;
                                $.each(respuesta.RespPregRelacione, function(k, item) {
                                    const select = document.querySelector(
                                        '#select' + cons);
                                    const opciones = document.querySelector(
                                        '#opciones' + cons);
                                    const contenidoSelect = document.querySelector(
                                        '#select' + cons + ' .contenido-select');
                                    const hiddenInput = document.querySelector(
                                        '#inputSelect' + cons);
                                    const sel = document.querySelectorAll(
                                        '#opciones' + cons + ' > .opcion')

                                    contenidoSelect.innerHTML = sel[item.consecu -
                                        1].innerHTML;
                                    select.classList.toggle('active');
                                    $.selopc(item.consecu, cons)
                                    cons++;
                                });

                            } else if (tipo === "TALLER") {
                                $("#Puntaje" + id).html(respuesta.PregTaller.puntaje +
                                    " Puntos");

                                $("#CargArchi").val("");

                                Pregunta +=
                                    '<div class="row"><div class="col-md-12 pb-1">' +
                                    ' <label class="form-label " for="imagen">Ver Archivo Cargado:</label>' +
                                    ' <div class="btn-group" role="group" aria-label="Basic example">' +
                                    '   <button id="idimg' + id +
                                    '" type="button" data-archivo="' + respuesta.PregTaller
                                    .nom_archivo +
                                    '" onclick="$.MostArc(this.id);" class="btn btn-success"><i' +
                                    '             class="fa fa-download"></i> Descargar Archivo</button>' +
                                    '      </div>' +
                                    '</div></div>';

                                Pregunta += ' <div class="row">' +
                                    '   <div class="col-md-12">' +
                                    '       <div class="form-group" id="divarchi">' +
                                    '       <h6 class="form-section"><strong>Agregar Desarrollo de Taller: </strong> </h6>' +
                                    '             <input id="archiTaller"  name="archiTaller" type="file">' +
                                    '       </div>' +
                                    '  </div>' +
                                    '</div>';

                                $("#Pregunta" + id).html(Pregunta);

                                var archivo = "";

                                if (respuesta.RespPregTaller) {
                                    $("#CargArchi").val(respuesta.RespPregTaller.archivo);
                                    archivo +=
                                        ' <div class="form-group" id="id_file" style="display:none;">' +
                                        '<label class="form-label " for="imagen">Agregar Desarrollo de Taller: </label>' +
                                        '<input type="file" id="archiTaller" name="archiTaller" />' +
                                        '</div>' +
                                        '<div class="form-group" id="id_verf">' +
                                        '<label class="form-label " for="imagen">Ver Desarrollo de Taller: </label>' +
                                        '<div class="btn-group" role="group" aria-label="Basic example">' +
                                        '<button type="button" id="archi" onclick="$.VerArchResp(this.id);" data-archivo="' +
                                        respuesta.RespPregTaller.archivo +
                                        '" class="btn btn-success"><i' +
                                        '            class="fa fa-search"></i> Ver Archivo</button>' +
                                        '<button type="button" onclick="$.CambArchivo();" class="btn btn-warning"><i' +
                                        '           class="fa fa-refresh"></i> Cambiar Archivo</button>' +
                                        ' </div>' +
                                        ' </div>';

                                    $("#divarchi").html(archivo);
                                }

                            }

                        }

                    });

                },
                selopc: function(id, cons) {
                    $("#RespSelect" + cons).val($("#" + id).data("id"));
                    $("#ConsPreg" + cons).val(id);

                },
                CambArchivo: function() {
                    $("#id_file").show();
                    $("#id_verf").hide();
                    $("#CargArchi").val("");
                },
                MostListEval: function() {
                    $("#Div_DetEval").hide();
                    $("#DivProduccion").show();
                    
                },
                VerArchResp: function(id) {
                    window.open($('#Respdattaller').data("ruta") + "/" + $('#' + id).data("archivo"),
                        '_blank');
                },
                MostArc: function(id) {
                    window.open($('#RutaUrl').data("ruta") + "/app-assets/Archivos_EvaluacionTaller/" +
                        $('#' + id).data("archivo"), '_blank');
                },
                GuarPreg: function(id, npreg) {
                    for (var instanceName in CKEDITOR.instances) {
                        CKEDITOR.instances[instanceName].updateElement();
                    }
                    flagGlobal = "n";
                    var form = $("#Evaluacion");
                    var url = form.attr("action");
                    var IdEval = $("#IdEval").val();
                    var token = $("#token").val();
                    var Id_Doce = $("#Id_Doce").val();
                    var archivo = $("#CargArchi").val();
                    var Preg = $("#id-pregunta" + id).val();
                    var tipo = $("#tip-pregunta" + id).val();
                    var tiempo = $("#tiempEvaluacion").val();
                    if ($("#Tip_Usu").val() === "Estudiante") {

                        if (tipo === "OPCMULT") {
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
                        } else if (tipo === "VERFAL") {
                            var sel = "n";
                            if ($("input:radio[name='radpregVerFal[]']").is(":checked")) {
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

                        } else if (tipo === "RELACIONE") {
                            var sel = "s";
                            $("input[name='RespSelect[]']").each(function(indice, elemento) {
                                if ($(elemento).val() === '') {
                                    sel = "n";
                                }
                            });

                            if (sel === "n") {
                                flagGlobal = "s";
                                mensaje = "No se han completado las relaciones";
                                swal({
                                    title: "",
                                    text: mensaje,
                                    icon: "warning",
                                    button: "Aceptar",
                                });
                                return;
                            }
                        } else if (tipo === "TALLER") {
                            var sel = "s";
                            if ($('#archiTaller').val()) {

                            } else {
                                sel = "n";
                            }

                            if (sel === "n" && archivo === "") {
                                flagGlobal = "s";
                                mensaje = "No se ha cargado ningun archivo";
                                swal({
                                    title: "",
                                    text: mensaje,
                                    icon: "warning",
                                    button: "Aceptar",
                                });
                                return;
                            }


                        }

                        if (flagIntent === "fail" && $("#Tip_Usu").val() === "Estudiante") {
                            flagGlobal = "s";
                            mensaje = "Ha superado Los Intentos Permitidos";
                            swal({
                                title: "",
                                text: mensaje,
                                icon: "warning",
                                button: "Aceptar",
                            });
                            return;
                        }

                    } else {
                        return;
                    }

                    $("#Pregunta").remove();
                    $("#TipPregunta").remove();
                    $("#nPregunta").remove();
                    $("#NArchivo").remove();
                    $("#IdEvaluacion").remove();
                    $("#idtoken").remove();
                    $("#Id_Docente").remove();
                    $("#Tiempo").remove();
                    form.append("<input type='hidden' name='Pregunta' id='Pregunta' value='" +
                        Preg + "'>");
                    form.append("<input type='hidden' name='nPregunta' id='nPregunta' value='" +
                        npreg + "'>");
                    form.append(
                        "<input type='hidden' name='TipPregunta' id='TipPregunta' value='" + tipo +
                        "'>");
                    form.append(
                        "<input type='hidden' name='NArchivo' id='NArchivo' value='" + archivo +
                        "'>"
                    );
                    form.append("<input type='hidden' name='IdEvaluacion' id='IdEvaluacion' value='" +
                        IdEval + "'>");
                    form.append("<input type='hidden' id='idtoken' name='_token'  value='" + token +
                        "'>");
                    form.append("<input type='hidden' id='Id_Docente' name='Id_Docente'  value='" +
                        Id_Doce + "'>");
                    form.append("<input type='hidden' id='Tiempo' name='Tiempo'  value='" +
                        tiempo + "'>");



                    if (tipo === "TALLER") {
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: new FormData($('#Evaluacion')[0]),
                            processData: false,
                            contentType: false,
                            success: function(respuesta) {
                                if (npreg === "Ultima") {
                                    $.MostrResulEval(respuesta);
                                }

                            },
                            error: function() {
                                mensaje = "La Evaluación no pudo ser Guardada";
                                swal({
                                    title: "",
                                    text: mensaje,
                                    icon: "warning",
                                    button: "Aceptar",
                                });
                            }
                        });
                    } else {
                        var datos = form.serialize();

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: datos,
                            dataType: "json",
                            async: false,
                            success: function(respuesta) {
                                if (npreg === "Ultima") {
                                    $.MostrResulEval(respuesta);
                                }
                            },
                            error: function() {
                                mensaje = "La Evaluación no pudo ser Guardada";
                                swal({
                                    title: "",
                                    text: mensaje,
                                    icon: "warning",
                                    button: "Aceptar",
                                });
                            }
                        });

                    }


                    if (npreg === "Ultima") {

                    } else {
                        $("#Pregunta" + id).html("");
                    }


                },
                MostrResulEval: function(respuesta) {
                    $("#DetEvalFin").html("");
                   
                    document
                        .getElementById(
                            "cuenta")
                        .innerHTML =
                        "EVALUACIÓN TERMINADA";
                    swal({
                        title: "Notificación de Evaluación",
                        text: "La Evaluación fue Guardada Exitosamente",
                        icon: "success",
                        button: "Aceptar",
                    });
                    var IntReal = respuesta.InfEval.int_realizados;
                    var IntPerm = respuesta.InfEval.intentos_perm;
                    var puntMax = parseInt(respuesta.InfEval.punt_max);
                    var puntTotal = parseInt(respuesta.Libro.puntuacion);
                    var TipCali = respuesta.InfEval.calif_usando;

                    $("#titu_Eva").hide();
                    $("#Enunaciado").hide();
                    $("#EvalPreguntas").hide();
                    $("#btn_eval").hide();
                    $("#DetEvalFin").show();


                    $("#DetEvalFin").append("<h4>Resultado de Evaluación</h4>");
                    var tiempoEval = "";
                    var tiempoUsad = "";

                    if (respuesta.InfEval.hab_tiempo === "NO") {
                        tiempoEval = "Esta Evaluación no Cuenta con un tiempo para su Desarrollo";
                        tiempoUsad = "No Aplica";
                    } else {
                        tiempoEval = respuesta.InfEval.tiempo;
                        tiempoUsad = respuesta.Libro.tiempo_usado;
                    }

                    $("#label_IntReal").html(IntReal);


                    var contenido = '<div class="card">' +
                        '<div class="card-content">' +
                        '  <div class="card-body">' +
                        '    <p class="h7">' + respuesta.InfEval.titulo + '</p>' +
                        '  </div>' +
                        '  <ul class="list-group list-group-flush">' +
                        '    <li class="list-group-item">' +
                        '      <span class="badge badge-default badge-pill bg-info float-right">' +
                        respuesta.InfEval.titu_contenido + '</span><b>Nombre del Tema:</b>  ' +
                        '    </li>' +
                        '    <li class="list-group-item">' +
                        '      <span class="badge badge-default badge-pill bg-info float-right">' +
                        tiempoEval + '</span> <b>Tiempo de la Evaluación:</b>' +
                        '    </li>' +
                        '     <li class="list-group-item">' +
                        '       <span class="badge badge-default badge-pill bg-danger float-right">' +
                        tiempoUsad + '</span> <b>Tiempo Utilizado:</b>' +
                        '</li>' +
                        '<li class="list-group-item">' +
                        '<span class="badge badge-default badge-pill bg-warning float-right">' +
                        respuesta.InfEval.int_realizados + '/' + respuesta.InfEval.intentos_perm +
                        '</span> <b>Intentos</b>' +
                        '</li>' +
                        '<li class="list-group-item">' +
                        '<span id="txt_califVis" class="badge badge-default badge-pill  float-right">30/60</span> <b>Calificación:</b> ' +
                        '</li>' +
                        '</ul>' +
                        '</div>' +
                        '</div>';

                    $("#DetEvalFin").append(contenido);

                    if (respuesta.InfEval.calxdoc == "SI") {
                        $("#txt_califVis").css('background-color', '#2DCEE3');
                        $("#txt_califVis").html("PENDIENTE POR CALIFICAR.");

                    } else {
                        var porcentaje = (puntTotal / puntMax) * 100;
                        if (porcentaje <= 50) {
                            $("#txt_califVis").css('background-color', '#f20d00');
                        } else if (porcentaje > 50 && porcentaje <= 60) {
                            $("#txt_califVis").css('background-color', '#F08D0E');
                        } else if (porcentaje > 60 && porcentaje <= 70) {
                            $("#txt_califVis").css('background-color', '#F5DA00');
                        } else if (porcentaje > 70 && porcentaje <= 80) {
                            $("#txt_califVis").css('background-color', '#C0EA1C');
                        } else if (porcentaje > 80 && porcentaje <= 100) {
                            $("#txt_califVis").css('background-color', '#1ECD60');
                        }
                        $("#txt_califVis").css('color', '#ffffff');

                        if (TipCali == "Puntos") {
                            $("#txt_califVis").html(puntTotal + "/" + puntMax);
                        } else if (TipCali == "Porcentaje") {
                            $("#txt_califVis").html(porcentaje + "%");
                        } else {
                            switch (true) {
                                case (porcentaje < 35):
                                    $("#txt_califVis").html("Super Bajo");
                                    break;
                                case (porcentaje >= 35 && porcentaje < 60):
                                    $("#txt_califVis").html("Bajo");
                                    break;
                                case (porcentaje >= 60 && porcentaje < 80):
                                    $("#txt_califVis").html("Basico");
                                    break;
                                case (porcentaje >= 80 && porcentaje < 95):
                                    $("#txt_califVis").html("Alto");
                                    break;
                                case (porcentaje >= 95):
                                    $("#txt_califVis").html("Superior");
                                    break;
                            }
                        }

                    }

                },
                hab_ediContPregEnsayo: function() {
                    CKEDITOR.replace('RespPregEns', {
                        width: '100%',
                        height: 100
                    });
                },
            });


        });
    </script>
@endsection
