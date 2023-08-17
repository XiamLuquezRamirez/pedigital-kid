@extends('Plantilla.Principal')
@section('title', 'Módulo de Entrenamiento')
@section('Contenido')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" class="form-control" id="Ruta" data-ruta="{{ Session::get('URL') }}/app-assets/" />
    <input type="hidden" data-id='id-dat' id="Respdattaller"
        data-ruta="{{ asset('/app-assets/Archivos_EvalTaller_Resp') }}" />
    <input type="hidden" class="form-control" id="IdEval" value="" />
    <input type="hidden" class="form-control" id="tiempEvaluacion" value="" />
    <input type="hidden" class="form-control" name="CargArchi" id="CargArchi" value="" />
    <input type="hidden" class="form-control" id="Id_Doce" value="{{ Session::get('DOCENTE') }}" />




    <section class="row pb-1" style="margin-left: 20px;margin-right: 20px;">
        <div class="container" style="margin-top: -40px;">
            <div id="principal" class="row">
                <div class="col-lg-6 res-margin" style="padding-bottom: 10px;">
                    <!-- blog-box -->
                    <div class="blog-box">
                        <!-- image -->
                        <a href="">
                            <div class="image"><img
                                    src="{{ Session::get('URL') . '/app-assets/images/Img_ModuloE/MODULOE_ASIGNATURAS.jpg' }}"
                                    alt=""></div>
                        </a>

                        <!-- blog-box-caption -->
                        <div class="blog-box-caption">
                            <!-- date -->
                            <div class="date"><span class="day">{!! $Gradoalumno . '°' !!}</span><span
                                    class="month">Grado</span></div>
                            <a href="">
                                <h5>ASIGNATURAS MÓDULO E</h5>
                            </a>
                            <!-- /link -->
                            <p>
                                Aquí se podra realizar una retroalimentación de diferentes temas buscando reforzar tus
                                conocimientos.
                            </p>
                        </div>
                        <!-- blog-box-footer -->
                        <div class="blog-box-footer">
                            <!-- Button -->
                            <div class="text-center col-md-12">
                                <a onclick="$.EnntrarAsignaturas();" class="btn btn-primary ">Entrar</a>
                            </div>
                        </div>
                        <!-- /blog-box-footer -->
                    </div>
                    <!-- /blog-box -->
                </div>
                <div class="col-lg-6 res-margin" style="padding-bottom: 10px;">
                    <!-- blog-box -->
                    <div class="blog-box">
                        <!-- image -->
                        <a href="">
                            <div class="image"><img
                                    src="{{ Session::get('URL') . '/app-assets/images/Img_ModuloE/MODULOE_ENTRENAMIENTO.jpg' }}"
                                    alt=""></div>
                        </a>

                        <!-- blog-box-caption -->
                        <div class="blog-box-caption">
                            <!-- date -->
                            <div class="date"><span class="day">{!! $Gradoalumno . '°' !!}</span><span
                                    class="month">Grado</span></div>
                            <a href="">
                                <h5>ENTRENAMIENTO </h5>
                            </a>
                            <!-- /link -->
                            <p>
                                Aqui encontraras Simulacros diseñados para medir tus conocimientos
                            </p>
                        </div>
                        <!-- blog-box-footer -->
                        <div class="blog-box-footer">
                            <!-- Button -->
                            <div class="text-center col-md-12">
                                <a href="{{ url('/ModuloE/CargarSimulacros') }}" class="btn btn-primary ">Entrar</a>
                            </div>
                        </div>
                        <!-- /blog-box-footer -->
                    </div>
                    <!-- /blog-box -->
                </div>
            </div>
            <div id="ListAsig" style="display: none;" class="row">
            </div>
            <div id="ListTemas" style="display: none;" class="row">
                <div class="col-lg-12">
                    <h2 class="element-heading col-lg-12" id="Titulo"></h2>
                </div>
                <div class="col-lg-12" id="div-temas">

                </div>
                <di v class="row" id="div-detTemas" style="display: none; ">

            </div>
            <div class="col-lg-12" id="div-practiquemos">
                <div id="listPracticas" style="display: none; width: 100%;"></div>
                <div class="list-group" id="Div_DetEval" style="display: none;width: 100%;">
                    <input type="hidden" class="form-control" id="IdEval" value="" />
                    <input type="hidden" class="form-control" id="Id_PregEns" value="" />
                    <input type="hidden" class="form-control" id="TipEva" value="" />
                    <div class="col-md-12">
                        <div class="row">
                            <!-- contact-info-->
                            <div class="contact-info col-lg-12" style="text-align: left;">
                                <!-- contact-info-->
                                <h3 class="mb-2" id="Tit_Eval"></h3>
                                <p class="h7" id="titu_Eva"></p>
                                <div id="Enunaciado"></div>

                                <div id="EvalPreguntas">

                                </div>

                                <div id="DetEvalFin">

                                </div>



                                <!-- /contactform-->
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
                                                    <p style="font-size: 20px;font-weight: bold;" id='cuenta'>---</p>
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
                                                    <p style="font-size: 20px;font-weight: bold;" id='label_IntPerm'>2</p>
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
                                                    <p style="font-size: 20px;font-weight: bold;" id='label_IntReal'>3</p>
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

            <div class="col-lg-12">
                <div id="counter" class="container">
                    <div class="row offset-lg-1" style="text-align: right;">
                        <!-- Counter -->
                        <div class="col-xl-9 col-md-4">
                        </div>
                        <div class="col-xl-2 col-md-2" onclick="$.AbrirAnimaciones();"
                            style="display: none; text-align: right; cursor: pointer;" id="btn-animaciones">
                            <div class="counter">
                                <div class="counter-wrapper bg-primary hvr-grow-shadow  p-2">
                                    <i class="counter-icon flaticon-teacher" style="font-size:33px;"></i>
                                    <!-- insert your final value on data-count= -->
                                    <h3 class="title">Animaciones</h3>
                                </div>
                            </div>
                            <!-- /counter -->
                        </div>
                        <!-- /col-lg -->
                        <!-- Counter -->
                        <div class="col-xl-1 col-md-2" onclick="$.AbrirListPractica();"
                            style="display: none;  text-align: right;cursor: pointer;" id="btn-practica">
                            <div class="counter">
                                <div class="counter-wrapper bg-secondary hvr-grow-shadow p-2">
                                    <i class="counter-icon  flaticon-family " style="font-size:33px;"> </i>
                                    <!-- insert your final value on data-count= -->
                                    <h3 class="title">Practica</h3>
                                </div>
                            </div>
                            <!-- /counter -->
                        </div>
                        <!-- /col-lg -->
                        <!-- Counter -->

                        <!-- /col-lg -->
                    </div>
                    <!-- /row -->
                </div>

            </div>

            <div class="row" id="ListDetCal" style="display: none;">
                <div class="col-12">
                    <h3 class="elements-subheader" id="titResulval">Resultado Evaluación</h3><br>
    
                </div>
                <div class="col-12" id="div-listPreg">
    
                </div>
                <div class="col-12">
                    <a class="custom-link float-right mt-5" style="cursor: pointer;" id="back-eval"
                        onclick="$.AtrasRetro();">Atras</a>
    
                </div>
    
            </div>
    
            <div class="modal fade text-left" id="modDetEval" tabindex="-1" role="dialog" aria-labelledby="myModalLabel15"
                aria-hidden="true">
                <div class="modal-dialog  modal-lg" role="document">
                    <div class="modal-content">
                        <div class="card card-body">
                            <h4 class="card-title">Retroalimentación de la Pregunta</h4>
                            <div id="DetRespPregunta">
    
                            </div>
                            <a href="#" data-dismiss="modal" class="btn btn-primary">
                                <li class="fa fa-arrow-alt-circle-left"></li> Atras
                            </a>
                        </div>
    
                    </div>
                </div>
            </div>

             <a class="custom-link float-right mt-2" onclick="javascript: history.back();" style="cursor: pointer;"
                id="btn-atras">Atras</a>

        </div>
        </div>
    </section>

    {!! Form::open(['url' => '/ModuloE/cargarAsignaturas', 'id' => 'formAuxiliarAsignaturas']) !!}
    {!! Form::close() !!}
    {!! Form::open(['url' => '/ModuloE/CargarTemasModuloE', 'id' => 'formAuxiliar']) !!}
    {!! Form::close() !!}

    {!! Form::open(['url' => '/ModuloE/CargaDetTemasModuloE', 'id' => 'formAuxiliarTemas']) !!}
    {!! Form::close() !!}

    {!! Form::open(['url' => '/ModuloE/CargarPracticas', 'id' => 'formConsuAct']) !!}
    {!! Form::close() !!}


    {!! Form::open(['url' => '/Cambiar/ContenidoEva', 'id' => 'formContenidoEva']) !!}
    {!! Form::close() !!}

    {!! Form::open(['url' => '/Calificaciones/VerRespAlumno', 'id' => 'formAuxiliarCargEval']) !!}
    {!! Form::close() !!}

    {!! Form::open(['url' => '/Calificaciones/ConsulRetroalimentacion', 'id' => 'formCalifRetro']) !!}
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

            let btnAtras = document.getElementById("btn-atras");
            let divDetalletema = document.getElementById("div-detTemas");
            let AsigSel = "";
            var myClass = ["primary", "secondary", "success", "danger",
                "warning", "info", "light", "dark"
            ];

            $.extend({
                EnntrarAsignaturas: function() {
                    var form = $("#formAuxiliarAsignaturas");
                    form.append(
                        "<input type='hidden' name='idPrueb' id='idPrueb' value='CargAsignaturas'>");
                    var url = form.attr("action");
                    var datos = form.serialize();

                    var asignaturas = '';

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        dataType: "json",
                        success: function(respuesta) {


                            $.each(respuesta.Asignatura, function(i, item) {
                                console.log("entra");
                                asignaturas +=
                                    '<div class="col-lg-4 res-margin" style="padding-bottom: 10px;">' +
                                    ' <div class="blog-box">' +
                                    '  <a href="">' +
                                    '<div class="image"><img' +
                                    ' src="{{ Session::get('URL') }}/app-assets/images/Img_ModuloE/' +
                                    item.imagen + '"' +
                                    'alt=""></div>' +
                                    '</a>' +
                                    '<div class="blog-box-caption">' +
                                    '<div class="date"><span class="day">' + item
                                    .grado + '°</span><span' +
                                    'class="month">Grado</span></div>' +
                                    '<a href="">' +
                                    '<h5>' + item.nombre + '</h5>' +
                                    '</a>' +
                                    '<p>' +
                                    '</p>' +
                                    ' </div>' +
                                    '<div class="blog-box-footer">' +
                                    '<div class="text-center col-md-12">' +
                                    '<a onclick="$.CargTemas(' + item.id +
                                    ');" class="btn btn-primary ">Entrar</a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';

                            })

                            $("#ListAsig").html(asignaturas);
                        }

                    });
                    $("#ListAsig").show();
                    $("#principal").hide();

                },

                CargTemas: function(id) {

                    $("#ListAsig").hide();
                    $("#ListTemas").show();

                    btnAtras.setAttribute("onclick", "$.atrasAsignaturas()");

                    var form = $("#formAuxiliar");
                    $("#idAsig").remove();
                    form.append("<input type='hidden' name='idAsig' id='idAsig' value='" + id + "'>");
                    var url = form.attr("action");
                    var datos = form.serialize();
                    var contenido = '';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        dataType: "json",
                        success: function(respuesta) {
                            AsigSel = respuesta.NomAsig;
                            $("#Titulo").html(AsigSel);


                            var margin = "";
                            var x = 1;

                            $.each(respuesta.Temas, function(i, item) {
                                var rand = Math.floor(Math.random() * myClass
                                    .length);
                                var rValue = myClass[rand];
                                contenido += '<div class="col-lg-12 res-margin" >';

                                x > 1 ? margin = "mt-1" : margin = "";

                                if (item.tipo_contenido == "DOCUMENTO") {
                                    contenido += '<div onclick="$.MostConteDoc(' +
                                        item.id +
                                        ');" style="cursor: pointer; text-align:left; width: 100%;" class="alert alert-' +
                                        rValue + ' ' + margin +
                                        ' hvr-grow-shadow" role="alert">' + item
                                        .titulo + '</div>';
                                } else if (item.tipo_contenido == "IMAGEN") {
                                    contenido += '<div onclick="$.MostConteImg(' +
                                        item.id +
                                        ');" style="cursor: pointer; text-align:left; width: 100%;" class="alert alert-' +
                                        rValue + ' ' + margin +
                                        ' hvr-grow-shadow" role="alert">' + item
                                        .titulo + '</div>';
                                } else {
                                    contenido += '<div onclick="$.MostConteVid(' +
                                        item.id +
                                        ');" style="cursor: pointer; text-align:left; width: 100%;" class="alert alert-' +
                                        rValue + ' ' + margin +
                                        ' hvr-grow-shadow" role="alert">' + item
                                        .titulo + '</div>';
                                }
                                x++;
                                contenido += '</div>';
                            });

                            $("#div-temas").html(contenido);

                        }
                    });

                },

                atrasAsignaturas: function() {
                    $("#ListAsig").show();
                    $("#ListTemas").hide();
                },
                atrasTemas: function() {
                    $("#div-temas").show();
                    $("#div-detTemas").hide();
                    btnAtras.setAttribute("onclick", "$.atrasAsignaturas()");
                    $("#Titulo").html(AsigSel);
                    $("#btn-practica").hide();
                    $("#btn-animaciones").hide();
                    


                },
                atrasEval: function() {

                    $("#listPracticas").hide();
                    btnAtras.setAttribute("onclick", "$.atrasTemas()");
                    let idtema = $("#idTem").val();
                    if (tipCont == "DOC") {
                        $.MostConteDoc(idtema);
                    } else if (tipCont == "IMG") {
                        $.MostConteImg(idtema);

                    } else {
                        $.MostConteVid(idtema);

                    }

                },
                atrasDetEval: function() {

                    btnAtras.setAttribute("onclick", "$.atrasEval()");
                    $("#listPracticas").show();
                    $("#Div_DetEval").hide();
                    clearInterval(xtiempo);

                },

                MostConteDoc: function(id) {
                    $("#div-temas").hide();
                    $("#div-detTemas").show();
                    tipCont = "DOC";
                    btnAtras.setAttribute("onclick", "$.atrasTemas()");
                    divDetalletema.style.height = "400";
                    divDetalletema.style.overflow = "auto";
                    divDetalletema.style.textAlign = "justify";

                    $("#btn-practica").hide();
                    $("#btn-animaciones").hide();

                    var form = $("#formAuxiliarTemas");
                    $("#idTem").remove();
                    $("#TipCont").remove();
                    form.append("<input type='hidden' name='idTem' id='idTem' value='" + id + "'>");
                    form.append("<input type='hidden' name='TipCont' id='TipCont' value='DOC'>");

                    var url = form.attr("action");
                    var datos = form.serialize();
                    var contenido = '';

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        dataType: "json",
                        async: false,
                        success: function(respuesta) {
                            $("#Titulo").html(respuesta.Tema.titulo);

                            contenido += '<div class="col-lg-12 col-md-12" > ' +
                                '  <div class="card">' +
                                '    <div class="card-content" style="height: 400px; overflow: auto;">' +
                                '      <div class="card-body" >' +
                                respuesta.TemasDet.contenido +
                                '  </div>' +
                                '  </div>' +
                                ' </div>' +
                                '   </div>';

                            respuesta.npractica > 0 ? $("#btn-practica").show() : $(
                                "#btn-practica").hide();
                            respuesta.Tema.animacion == "SI" ? $("#btn-animaciones")
                                .show() : $("#btn-animaciones").hide();
                        }
                    });
                    $("#div-detTemas").html(contenido);

                },
                MostConteImg: function(id) {
                    tipCont = "IMG";

                    $("#div-temas").hide();
                    $("#div-detTemas").show();
                    btnAtras.setAttribute("onclick", "$.atrasTemas()");

                    $("#btn-practica").hide();
                    $("#btn-animaciones").hide();

                    var form = $("#formAuxiliarTemas");
                    $("#idTem").remove();
                    $("#TipCont").remove();

                    form.append("<input type='hidden' name='idTem' id='idTem' value='" + id + "'>");
                    form.append("<input type='hidden' name='TipCont' id='TipCont' value='IMG'>");
                    var url = form.attr("action");
                    var datos = form.serialize();
                    var contenido = '';

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            $("#Titulo").html(respuesta.Tema.titulo);
                            contenido += '<div class="col-lg-2 col-md-2">';
                            $.each(respuesta.TemasDet, function(i, item) {
                                contenido +=
                                    ' <figure class="col-lg-12 col-md-12 col-12 "  itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">' +
                                    '     <a onclick="$.MostImgTema(this.id);" id="' +
                                    item.id + '"  data-archivo="' + item.imagen +
                                    '"  itemprop="contentUrl" >' +
                                    '      <img class="img-thumbnail img-fluid hvr-grow-shadow" src="' +
                                    $('#Ruta').data("ruta") +
                                    '/images/Imagen_Tema_ModuloE/' +
                                    item.imagen +
                                    '"" itemprop="thumbnail" alt="Image description">' +
                                    '    </a>' +
                                    ' </figure>';
                            });

                            contenido += '</div>';

                            contenido += '<div class="col-lg-10 col-md-10">' +
                                ' <div class="card">' +
                                ' <div class="card-content">' +
                                ' <div  id="div_img"  data-archivo="' +
                                respuesta.TemasDet.imagen +
                                '" style="cursor: pointer; text-align: center; height: 500px; overflow: scroll;" class="card-body">' +
                                ' <figure  class="col-lg-12 col-md-6 col-12 zoom " id="ex3" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">' +
                                ' <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails"> <img class="img-thumbnail img-fluid" style="height: 450px; " src="' +
                                $('#Ruta').data("ruta") + '/images/Imagen_Tema_ModuloE/' +
                                respuesta.primeImg + '"' +
                                ' itemprop="thumbnail" alt="Image descripción" /></div>' +

                                ' </figure>' +
                                ' </div>' +
                                ' </div>' +
                                ' </div>' +
                                ' </div>';


                            respuesta.npractica > 0 ? $("#btn-practica").show() : $(
                                "#btn-practica").hide();
                            respuesta.Tema.animacion == "SI" ? $("#btn-animaciones")
                                .show() : $("#btn-animaciones").hide();
                        }
                    });

                    $("#div-detTemas").html(contenido);

                    $('#ex3').zoom({
                        on: 'click'
                    });

                },
                MostImgTema: function(id) {



                    $("#div_img").html(
                        '<figure  class="col-lg-12 col-md-6 col-12 zoom " id="ex3"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">' +
                        '  <img class="img-thumbnail img-fluid" style="height: 450px; " src="' + $(
                            '#Ruta').data("ruta") +
                        '/images/Imagen_Tema_ModuloE/' + $('#' + id).data("archivo") + '"' +
                        '  itemprop="thumbnail" alt="Imagen Descripción" />' +

                        '   </figure>');

                    $('#ex3').zoom({
                        on: 'click'
                    });
                },
                MostConteVid: function(id) {
                    tipCont = "VID";

                    $("#div-temas").hide();
                    $("#div-detTemas").show();

                    $("#btn-practica").hide();
                    $("#btn-animaciones").hide();

                    $("#idTem").remove();
                    $("#TipCont").remove();
                    divDetalletema.style.textAlign = "center";
                    divDetalletema.style.width = "100%";

                    btnAtras.setAttribute("onclick", "$.atrasTemas()");

                    var form = $("#formAuxiliarTemas");
                    form.append("<input type='hidden' name='idTem' id='idTem' value='" + id + "'>");
                    form.append("<input type='hidden' name='TipCont' id='TipCont' value='VID'>");
                    var url = form.attr("action");
                    var datos = form.serialize();
                    var contenido = '';


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            $("#TemDetTit").html(respuesta.Tema.titulo);
                            contenido += '<div class="col-lg-12 col-md-12">' +
                                '  <div class="card" style="text-align: center;">' +
                                '    <div class="card-content">' +
                                '      <div data-archivo="' + respuesta.TemasDet.video +
                                '" id="div_vid"style="cursor: pointer;" class="card-body">' +
                                '       <video id="videoclipAnima" width="100%" height="360" controls="controls"' +
                                '  title="Video title">' +
                                '    <source id="mp4videoAnima" src="" type="video/mp4" />' +
                                '</video>' +
                                '  </div>' +
                                '  </div>' +
                                ' </div>' +
                                '   </div>';


                            respuesta.npractica > 0 ? $("#btn_Practica").show() : $(
                                "#btn_Practica").hide();
                        }
                    });



                    $("#div-detTemas").html(contenido);

                    var videoID = 'videoclipAnima';
                    var sourceID = 'mp4videoAnima';
                    var nomarchi = $('#div_vid').data("archivo");
                    var newmp4 = $('#Ruta').data("ruta") + "/Video_Tema_ModuloE/" + nomarchi;
                    $('#' + videoID).get(0).pause();
                    $('#' + sourceID).attr('src', newmp4);
                    $('#' + videoID).get(0).load();
                    $('#' + videoID).get(0).play();
                },

                AbrirListPractica: function() {

                    $("#div-detTemas").hide();
                    $("#listPracticas").show();

                    btnAtras.setAttribute("onclick", "$.atrasEval()");


                    $("#btn-practica").hide();
                    $("#btn-animaciones").hide();

                    var form = $("#formConsuAct");
                    var id = $("#idTem").val();

                    var contenido = '';
                    $("#Tema").remove();
                    $("#clasf").remove();
                    var Text_Coment = $("#Text_Coment").val();
                    form.append("<input type='hidden' name='Tema' id='Tema' value='" + id +
                        "'><input type='hidden' name='clasf' id='clasf' value='PRACTICA'>");
                    var url = form.attr("action");
                    var datos = form.serialize();
                    var j = 1;
                    let estadoEval="none";
                    contenido += "<div class='col-lg-12 col-md-12' > " +
                        "  <div class='card'>" +
                        "    <div class='card-content' style='height: 400px; overflow: auto;'>" +
                        "      <div class='card-body' >";

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            $("#TemDetTit").html(respuesta.TitTemas);
                            $.each(respuesta.Eval, function(i, item) {

                                var rand = Math.floor(Math.random() * myClass
                                    .length);
                                var rValue = myClass[rand];
                                
                                j > 1 ? margin = "mt-1" : margin = "";
                                item.evaluado=="CALIFICADA" ?  estadoEval="block" : estadoEval="none";
                               
                             

                                contenido += '<div class="col-lg-6 res-margin" >';

                                contenido += '<div class="input-group">'
                                   +'<div class="alert alert-'+  rValue + ' ' + margin +' hvr-grow-shadow" role="alert" style="cursor:pointer;" onclick="$.MostEval(' +   item.id + ');">'
                                    + j +  '. </strong>' + item.titulo.toLowerCase() 
                                   +'</div>'
                                   +'<span class="input-group-btn">'
                                   +'<div class="feature-with-icon ml-2" onclick="$.MostrasResultadoEval('+item.id+');" style="cursor:pointer;display:'+estadoEval+'" title="Revisar Calificación">'
                                   +' <div class="icon-features">'
                                   +'<i class="flaticon-conversation-1 text-secondary" style="font-size:50px;"></i>'
                                   +'</div>'
                                   +'</div>'
                                   +'</span>'
                                   +'</div>';

                             contenido += '</div>';


                                j++;
                            });
                        }
                    });

                    contenido += '</div></div></div></div>';

                    $("#listPracticas").html(contenido);



                },
                detalleEvaluacion: function(ideval) {

                    $("#modDetEval").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $('#VisTema').modal('toggle');

                    var form = $("#formCalifRetro");

                    $("#idEvalRetro").remove();

                    form.append("<input type='hidden' name='idEvalRetro' id='idEvalRetro' value='" +
                    ideval + "'>");
                    var url = form.attr("action");
                    var datos = form.serialize();
                    var Respreg = "";
                    var consPreg = 1;
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: false,
                        dataType: "json",
                        success: function(respuesta) {
                            $.each(respuesta.Retro, function(i, item) {

                                let retro = item.retro === null ?
                                    "No se realizo ninguna Retroalimentació" :
                                    "Se realizo una Retroalimentación";

                                if (item.promPunt >= 60) {
                                    Respreg +=
                                        '  <div class="bs-callout-success callout-transparent callout-bordered mt-1" >' +
                                        '<div class="media align-items-stretch">' +
                                        '<div class="media-body p-1">' +
                                        '<strong>Pregunta ' + consPreg +
                                        '</strong>' +
                                        '     <ul class="list-inline mb-1">' +
                                        '  <li class="pr-1">' +
                                        '  <a href="#"  class="">' +
                                        '  <span class="fa fa-thumbs-o-up"></span> Puntos: ' +
                                        item.puntos + ' Pts.</a>' +
                                        ' </li>' +
                                        '  <li class="pr-1">' +
                                        '  <a href="#"  onclick="$.VerRespPreg(' +
                                        item.pregunta + ');" class="">' +
                                        '  <span class="fa fa-eye"></span> Ver Respuesta</a>' +
                                        ' </li>' +
                                        '</ul>' +
                                        '    <h6 class="form-section"><i class="fa fa-undo"></i> ' +
                                        retro + '</h6>' +
                                        ' </div>' +
                                        ' <div class="d-flex align-items-center bg-success  position-relative callout-arrow-right p-2">' +
                                        '   <i class="fa fa-check-circle white font-medium-5"></i>' +
                                        '  </div>' +
                                        ' </div>' +
                                        '    </div>';
                                } else {
                                    Respreg +=
                                        '  <div  style="cursor: pointer;" class="bs-callout-warning  callout-transparent callout-bordered mt-1"";>' +
                                        '<div class="media align-items-stretch">' +
                                        '<div class="media-body p-1">' +
                                        '<strong>Pregunta ' + consPreg +
                                        '</strong>' +
                                        '     <ul class="list-inline mb-1">' +
                                        '  <li class="pr-1">' +
                                        '  <a href="#" class="">' +
                                        '  <span class="fa fa-thumbs-o-down"></span> Puntos: ' +
                                        item.puntos + ' Pts.</a>' +
                                        ' </li>' +
                                        '  <li class="pr-1">' +
                                        '  <a href="#"  onclick="$.VerRespPreg(' +
                                        item.pregunta + ');" class="">' +
                                        '  <span class="fa fa-eye"></span> Ver Respuesta</a>' +
                                        ' </li>' +
                                        '</ul>' +
                                        '    <h6 class="form-section"><i class="fa fa-undo"></i> ' +
                                        retro + '</h6>' +
                                        ' </div>' +
                                        ' <div class="d-flex align-items-center bg-warning  position-relative callout-arrow-right p-2">' +
                                        '   <i class="fa fa-times-circle white font-medium-5"></i>' +
                                        '  </div>' +
                                        ' </div>' +
                                        '    </div>';

                                }

                                consPreg++;

                            });

                            $("#RespPreg").html(Respreg);


                        }

                    });
                

            },

                MostEval: function(id) {

                    btnAtras.setAttribute("onclick", "$.atrasDetEval()");

                    $("#listPracticas").hide();
                    $("#Div_DetEval").show();

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
                    $("#back-eval").hide();
                    $("#Enunaciado").html("");
                    $("#titu_Eva").show();
                    $("#Enunaciado").show();
                    $("#EvalPreguntas").show();
                    $("#btn_eval").show();
                    $("#DetEvalFin").hide();


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

                            console.log(int_perm);

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
                                    '      <div class="col-md-9" style="text-align:left;"><h5 class="primary">Pregunta ' +
                                    Preg + '</h5></div>' +
                                    '      <div class="col-md-3"><span class=" float-right"><i class="fa fa-circle" style="color: #1ECD60"></i id="Puntaje' +
                                    ConsPre + '"> 10 Puntos</span></div>' +
                                    '      <div class="col-md-12" style="text-align:left;" id="Pregunta' +
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

                                        clearInterval();

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
                                            xtiempo = setInterval(function() {

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
                                        $("#listPracticas").show();
                                        $("#Div_DetEval").hide();
                                    }
                                });
                            } else {
                                {{--  $("#Div_ListEva").hide();
                                $("#Div_DetEval").show();  --}}

                            }


                        }

                    });


                },

                CargPreg: function(id) {

                    var form = $("#formAuxiliarCargEval");
                    var Preg = $("#id-pregunta" + id).val();
                    var tipo = $("#tip-pregunta" + id).val();
                    var IdEval = $("#IdEval").val();

                    var opci = "";
                    var parr = "";
                    var punt = "";

                    $("#Pregunta").remove();
                    $("#TipPregunta").remove();
                    form.append("<input type='hidden' name='PreguntaResp' id='Pregunta' value='" +
                        Preg + "'>");
                    form.append(
                        "<input type='hidden' name='TipPregunta' id='TipPregunta' value='" + tipo +
                        "'>"
                    );
                    form.append(
                        "<input type='hidden' name='idEvaVerResp' id='idEvaVerResp' value='" + IdEval +
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
                                    for (var i = 0; i < sel.length; i++) {
                                        var item2 = sel[i];
                                        let optioSel = item2.getAttribute(
                                            'data-id');
                                        if (item.respuesta_alumno == optioSel) {

                                            contenidoSelect.innerHTML = sel[i]
                                                .innerHTML;
                                        }

                                    }
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


                    if (flagIntent === "fail") {
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

                    clearInterval(xtiempo);
                    xtiempo = null;


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
                hab_ediContComplete: function() {
                    CKEDITOR.replace('RespPregComplete', {
                        width: '100%',
                        height: 100
                    });
                },
                RespMulPreg: function(id) {

                    $('.OpcionSel').val("no");

                    if ($('#' + id).prop('checked')) {
                        $('.checksel').prop("checked", "");
                        $('#' + id).prop("checked", "checked");
                        $('#OpcionSel_' + id).val("si");
                    }

                },
                selopc: function(id, cons) {
                    $("#RespSelect" + cons).val($("#" + id).data("id"));
                    $("#ConsPreg" + cons).val(id);

                },
                MostArc: function(id) {
                    window.open($('#Ruta').data("ruta") + "Archivos_EvaluacionTaller/" +
                        $('#' + id).data("archivo"), '_blank');
                },
                VerArchResp: function(id) {
                    window.open($('#Respdattaller').data("ruta") + "/" + $('#' + id).data("archivo"),
                        '_blank');
                },
                CambArchivo: function() {
                    $("#id_file").show();
                    $("#id_verf").hide();
                    $("#CargArchi").val("");
                },
                MostrasResultadoEval: function(idEval) {

                        $("#listPracticas").hide();
                        $("#ListDetCal").show();
                        $("#btn-atras").hide();

                        var form = $("#formCalifRetro");

                        $("#idEvalRetro").remove();

                        form.append("<input type='hidden' name='idEvalRetro' id='idEvalRetro' value='" +
                        idEval + "'>");
                        var url = form.attr("action");
                        var datos = form.serialize();
                        var Respreg = "";
                        var consPreg = 1;
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: datos,
                            async: false,
                            dataType: "json",
                            success: function(respuesta) {
                                $.each(respuesta.Retro, function(i, item) {

                                    let retro = item.retro === null ?
                                        "No se realizo ninguna Retroalimentació" :
                                        "Se realizo una Retroalimentación";


                                    if (item.promPunt >= 60) {
                                        Respreg +=
                                            '<div class="alert alert-success" role="alert">' +
                                            '<strong>Pregunta ' + consPreg +
                                            '</strong>' +
                                            '     <ul class="list-inline mb-1">' +
                                            '  <li class="pr-1">' +
                                            '  <a   class="">' +
                                            '  <span class="fa fa-thumbs-o-up"></span> Puntos: ' +
                                            item.puntos + ' Pts.</a>' +
                                            ' </li>' +
                                            '  <li class="pr-1">' +
                                            '  <a  style="cursor: pointer;"  onclick="$.VerRespPreg(' +
                                            item.pregunta + ');" class="">' +
                                            '  <span class="fa fa-eye"></span> Ver Respuesta</a>' +
                                            ' </li>' +
                                            '</ul>' +
                                            '    <h6 class="form-section"><i class="fa fa-undo"></i> ' +
                                            retro + '</h6>' +
                                            ' </div>' +
                                            '</div>';
                                    } else {
                                        Respreg +=
                                            '  <div class="alert alert-danger" role="alert">' +
                                            '<strong>Pregunta ' + consPreg +
                                            '</strong>' +
                                            '     <ul class="list-inline mb-1">' +
                                            '  <li class="pr-1">' +
                                            '  <a class="">' +
                                            '  <span class="fa fa-thumbs-o-up"></span> Puntos: ' +
                                            item.puntos + ' Pts.</a>' +
                                            ' </li>' +
                                            '  <li class="pr-1">' +
                                            '  <a style="cursor: pointer;"  onclick="$.VerRespPreg(' +
                                            item.pregunta + ');" class="">' +
                                            '  <span class="fa fa-eye"></span> Ver Respuesta</a>' +
                                            ' </li>' +
                                            '</ul>' +
                                            '    <h6 class="form-section"><i class="fa fa-undo"></i> ' +
                                            retro + '</h6>' +
                                            ' </div>' +
                                            ' </div>';

                                    }

                                    consPreg++;

                                });

                                $("#div-listPreg").html(Respreg);


                            }

                        });
                    



                },
                VerRespPreg: function(idpreg) {
                    var form = $("#formAuxiliarCargEval");
                    var eval = $("#idEvalRetro").val();
                    var Pregunta = "";
                    $("#PreguntaResp").remove();
                    $("#idEvaVerResp").remove();
                    form.append("<input type='hidden' name='PreguntaResp' id='PreguntaResp' value='" +
                        idpreg + "'>");
                    form.append(
                        "<input type='hidden' name='idEvaVerResp' id='idEvaVerResp' value='" +
                        eval +
                        "'>");

                    var url = form.attr("action");
                    var datos = form.serialize();

                    $("#RespPreg").hide();
                    $("#DetRespPregunta").show();
                    $("#btn_atras").hide();
                    $("#btn_atras2").show();

                    $("#modDetEval").modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: datos,
                        async: true,
                        dataType: "json",
                        success: function(respuesta) {

                            if (respuesta.tipo === "PREGENSAY") {

                                Pregunta += '<div class="alert alert-info" role="alert">' +
                                    '<strong>Pregunta</strong>' +
                                    '<div >' + respuesta.PregEnsayo.pregunta + '</div>' +
                                    '</div>';


                                Pregunta +=
                                    '<div class="alert alert-success" role="alert">' +
                                    '<strong>Respuesta</strong>' +
                                    '<div >' + respuesta.RespPregEnsayo.respuesta +
                                    '</div>' +
                                    '</div>';

                                if (respuesta.retro !== null) {

                                    Pregunta +=
                                        '<div class="alert alert-danger" role="alert">' +
                                        '<strong>Retroalimentación</strong>' +
                                        '<div >' + respuesta.retro + '</div>' +
                                        '</div>';
                                }

                                $("#DetRespPregunta").html(Pregunta);

                            } else if (respuesta.tipo === "COMPLETE") {

                                Pregunta += '<div class="alert alert-info" role="alert">' +
                                    '<strong>Complete el Parrafo con las Siguientes Opciones</strong>' +
                                    '<div >' + respuesta.PregComple.opciones + '</div>' +
                                    '<div >' + respuesta.PregComple.parrafo + '</div>' +
                                    '</div>';

                                Pregunta +=
                                    '<div class="alert alert-success" role="alert">' +
                                    '<strong>Respuesta</strong>' +
                                    '<div >' + respuesta.RespPregComple.respuesta +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';


                                if (respuesta.retro !== null) {

                                    Pregunta +=
                                        '<div class="alert alert-danger" role="alert">' +
                                        '<strong>Retroalimentación</strong>' +
                                        '<div >' + respuesta.retro + '</div>' +
                                        '</div>';
                                }

                                $("#DetRespPregunta").html(Pregunta);
                            } else if (respuesta.tipo === "OPCMULT") {

                                Pregunta += '<div class="alert alert-info" role="alert">' +
                                    '<strong>Seleccione una Opción Segun la siguiente Pregunta</strong>' +
                                    '<div >' + respuesta.PregMult.pregunta + '</div>' +
                                    '</div>';

                                Pregunta +=
                                    '<div class="alert alert-success" role="alert">' +
                                    '<strong>Opciones</strong>';
                                let cheked = "";
                                $.each(respuesta.OpciMult, function(i, item) {
                                    cheked = "";
                                    console.log(item.opciones);
                                    if (respuesta.RespPregMul.respuesta == item
                                        .id) {
                                        cheked = "checked";
                                    }

                                    Pregunta +=
                                        '<fieldset class="checkbox disabled">' +

                                        ' <input type="checkbox" value="" disabled="" ' +
                                        cheked + ' > ';
                                    Pregunta +=
                                        ' <label for="input-15"> ' +
                                        item
                                        .opciones +
                                        '</label>' +
                                        '</fieldset>';
                                });
                                '</div>' +
                                '</div>' +
                                '</div>';



                                if (respuesta.retro !== null) {

                                    Pregunta +=
                                        '<div class="alert alert-danger" role="alert">' +
                                        '<strong>Retroalimentación</strong>' +
                                        '<div >' + respuesta.retro + '</div>' +
                                        '</div>';

                                }

                                $("#DetRespPregunta").html(Pregunta);
                            } else if (respuesta.tipo === "VERFAL") {

                                Pregunta += '<div class="alert alert-info" role="alert">' +
                                    '<strong>Indique Verdadero o Falso segun la Afirmación</strong>' +
                                    '<div >' + respuesta.PregVerFal.pregunta + '</div>' +
                                    '</div>';

                                Pregunta +=
                                    '<div class="alert alert-success" role="alert">' +
                                    '<strong>Respuesta</strong>' +
                                    '<div class="form-group row">' +
                                    '<div class="col-md-12">' +
                                    '    <fieldset >' +
                                    '        <div class="input-group">';

                                Pregunta +=
                                    '<input name="radpregVerFal[]" id="RadVer" disabled value="si"  type="radio">';

                                Pregunta +=
                                    ' <div class="input-group-append" style="margin-left:5px;">' +
                                    '            <span  id="basic-addon2">Verdadero</span>' +
                                    '          </div>' +
                                    '        </div>' +
                                    '      </fieldset>' +
                                    '</div>' +
                                    '<div  class="col-md-12">' +
                                    '    <fieldset >' +
                                    '        <div class="input-group">';
                                Pregunta +=
                                    ' <input name="radpregVerFal[]" id="RadFal" disabled value="no"  type="radio">';
                                Pregunta +=
                                    '<div class="input-group-append" style="margin-left:5px;">' +
                                    '            <span  id="basic-addon2">Falso</span>' +
                                    '          </div>' +
                                    '        </div>' +
                                    '      </fieldset>' +
                                    '</div>' +
                                    '            </div>' +
                                    '</div>' +
                                    '</div>';



                                if (respuesta.retro !== null) {
                                    Pregunta +=
                                        '<div class="alert alert-danger" role="alert">' +
                                        '<strong>Retroalimentación</strong>' +
                                        '<div >' + respuesta.retro + '</div>' +
                                        '</div>';

                                }
                                $("#DetRespPregunta").html(Pregunta);

                                if (respuesta.RespPregVerFal) {
                                    if (respuesta.RespPregVerFal.respuesta_alumno ===
                                        "si") {
                                        $('#RadVer').prop("checked", "checked");
                                    } else {
                                        $('#RadFal').prop("checked", "checked");
                                    }
                                }

                            } else if (respuesta.tipo === "RELACIONE") {


                                Pregunta += '<div class="alert alert-info" role="alert">' +
                                    '<strong>' + respuesta.PregRelacione.enunciado +
                                        '</strong>' +
                                    '</div>';

                                        
                                Pregunta +=
                                '<div class="alert alert-success" role="alert">' +
                                    '<strong>Respuesta</strong>' +
                                    '<div class="row">';
                                let j = 1;
                                $.each(respuesta.PregRelIndi, function(k, item) {
                                    Pregunta +=
                                        '<div class="col-md-5 pb-2" style="display: flex;align-items: center;justify-content: center;"> <div  id="DivInd' +
                                        j + '">' + item.definicion + '</div></div>';

                                    Pregunta +=
                                        '<div class="col-md-2 pb-2" style="display: flex;align-items: center;justify-content: center;"><li class="fa fa-long-arrow-right"></li></div>';

                                    Pregunta +=
                                        '<div class="col-md-5 pb-2" style="display: flex;align-items: center;justify-content: center;"> <div  id="DivDefi' +
                                        j + '"></div></div>';
                                    j++;
                                });

                                Pregunta += '</div>' +
                                '</div>' +
                                '</div>';


                                if (respuesta.retro !== null) {
                                    Pregunta +=
                                    '<div class="alert alert-danger" role="alert">' +
                                    '<strong>Retroalimentación</strong>' +
                                    '<div >' + respuesta.retro + '</div>' +
                                    '</div>';
                                }

                                $("#DetRespPregunta").html(Pregunta);
                                j = 1;
                                $.each(respuesta.RespPregRelacione, function(k, item) {
                                    $("#DivDefi" + j).html(item.respuesta);
                                    j++;
                                });
                            } else if (respuesta.tipo === "TALLER") {
                                let id = "1";

                                Pregunta += '<div class="alert alert-info" role="alert">' +
                                    '<strong>Descrague el Archivo y desarrolla el Taller</strong>' +
                                    '<div class="row"><div class="col-md-12 pb-1">' +
                                        ' <label class="form-label " for="imagen">Ver Archivo Cargado:</label>' +
                                        ' <div class="btn-group" role="group" aria-label="Basic example">' +
                                        '   <button id="idimg' + id +
                                        '" type="button" data-archivo="' + respuesta.PregTaller
                                        .nom_archivo +
                                        '" onclick="$.MostArc(this.id);" class="btn btn-success"><i' +
                                        '             class="fa fa-download"></i> Descargar Archivo Docente</button>' +
                                        '      </div>' +
                                        '</div></div>' +
                                    '</div>';

                                    Pregunta +=
                                    '<div class="alert alert-success" role="alert">' +
                                   
                                            '<div class="form-group" id="id_verf">' +
                                            '<label class="form-label " for="imagen">Ver Desarrollo de Taller: </label>' +
                                            '<div class="btn-group" role="group" aria-label="Basic example">' +
                                            ' <button type="button" id="archi" onclick="$.VerArchResp(this.id);" data-archivo="' +
                                            respuesta.RespPregTaller.archivo +
                                            '" class="btn btn-success"><i' +
                                            '            class="fa fa-search"></i> Ver Archivo</button>' +
                                            ' </div>' +
                                            ' </div>' +
                                            ' </div>' +
                                            ' </div>';    


                                    if (respuesta.retro !== null) {
                                        Pregunta +=
                                        '<div class="alert alert-danger" role="alert">' +
                                        '<strong>Retroalimentación</strong>' +
                                        '<div >' + respuesta.retro + '</div>' +
                                        '</div>';
                                    }

                                $("#DetRespPregunta").html(Pregunta);


                            }


                        }
                    });
                },
                AtrasRetro: function() {
                    $("#ListDetCal").hide();
                    $("#listPracticas").show();
                },
                
            });


        });
    </script>
@endsection
