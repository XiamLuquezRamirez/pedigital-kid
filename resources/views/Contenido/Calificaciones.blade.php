@extends('Plantilla.Principal')
@section('title', 'Calificaciones')
@section('Contenido')
<input type="hidden" data-id='id-dat' id="dattaller"
data-ruta="{{ asset('/app-assets/Archivos_EvaluacionTaller') }}" />
<input type="hidden" data-id='id-dat' id="Respdattaller"
data-ruta="{{ asset('/app-assets/Archivos_EvalTaller_Resp') }}" />
<input type="hidden" class="form-control" id="RutaUrl" data-ruta="{{ Session::get('URL') }}" />
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="jumbo-heading" data-aos="fade-down">
                <h1 style="font-size: 30px;">
                    {{ $NomCom . ' - ' . $Asig->nombre . ' Grado ' . $Modulos->grado_modulo . '°' }} </h1>
            </div>
        </div>
        <!-- /container -->
    </div>
    <div class="container block-padding" style="padding-top: 40px;">
        <div class="row" id="ListCal">
            <h3 class="elements-subheader">Calificaciones</h3>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Evaluación</th>
                        <th>Estado</th>
                        <th>Calificación</th>
                        <th>Revisar</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp

                    @foreach ($Alumno as $Alum)
                        <tr data-id='{{ $Alum->id }}' id='alumno{{ $Alum->id }}'>
                            <td class="text-truncate" style="vertical-align: middle;">{!! $i !!}</td>
                            <td class="text-truncate" style="text-transform: capitalize;vertical-align: middle;">
                                {!! mb_strtolower($Alum->titulo) !!}</td>

                            @if ($Alum->calf_prof === 'no')
                                <td class="text-truncate" style="vertical-align: middle;">Pendiente</td>
                            @else
                                <td class="text-truncate" style="vertical-align: middle;">Presentada</td>
                            @endif

                            @php
                                if ($Alum->puntuacion !== null) {
                                    $puntMax = $Alum->punt_max;
                                    $Punt = explode('/', $Alum->puntuacion);
                                    $porc = $puntMax == 0 ? 0 : ($Punt[0] / $puntMax) * 100;
                                    //   $porc=($Punt[0] / $puntMax) * 100;
                                    $clase = 'btn bg-info btn-round mr-1 mb-1';
                                    switch ($porc) {
                                        case $porc <= 50:
                                            $clase = 'btn btn-danger btn-round mr-1 mb-1';
                                            break;
                                        case $porc > 50 && $porc <= 60:
                                            $clase = 'btn bg-warning  btn-round mr-1 mb-1';
                                            break;
                                        case $porc > 60 && $porc <= 70:
                                            $clase = 'btn bg-yellow  btn-round mr-1 mb-1';
                                            break;
                                        case $porc > 70 && $porc <= 80:
                                            $clase = 'btn btn-primary btn-round mr-1 mb-1';
                                            break;
                                        case $porc > 80 && $porc <= 100:
                                            $clase = 'btn bg-success btn-round mr-1 mb-1';
                                            break;
                                    }
                                
                                    if ($Alum->calf_prof == 'si') {
                                        $Calf = $Alum->calificacion;
                                    } else {
                                        $Calf = 'Por Calificar';
                                    }
                                } else {
                                    $Calf = '0/' . $Alum->punt_max;
                                    $clase = 'btn bg-info btn-round mr-1 mb-1';
                                }
                                
                                $i++;
                                
                            @endphp
                            <td class="text-truncate" style="vertical-align: middle;">
                                <button type="button" class="{!! $clase !!}">{!! $Calf !!}</button>
                            </td>
                            <td class="text-truncate" style="vertical-align: middle;">
                                <button type="button" id="btn_{{ $i }}" data-eval="{{ $Alum->evaluacion }}"
                                    data-prof="{{ $Alum->calf_prof }}" onclick="$.MostrasResultadoEval(this.id);"
                                    class="btn bg-info btn-round mr-1 mb-1">
                                    <li class="fa fa-search"></li>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

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

    </div>


    {!! Form::open(['url' => '/Calificaciones/ConsulRetroalimentacion', 'id' => 'formCalifRetro']) !!}
    {!! Form::close() !!}

    {!! Form::open(['url' => '/Calificaciones/VerRespAlumno', 'id' => 'formAuxiliarCargEval']) !!}
    {!! Form::close() !!}


@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#Men_Tablero").removeClass("nav-item active");
            $("#Men_Califica").addClass("nav-item active");


            $.extend({
                MostrasResultadoEval: function(id) {

                    let ide = $('#' + id).data("eval");
                    let calf = $('#' + id).data("prof");

                    if (calf === "si") {
                        $("#ListCal").hide();
                        $("#ListDetCal").show();

                        var form = $("#formCalifRetro");

                        $("#idEvalRetro").remove();

                        form.append("<input type='hidden' name='idEvalRetro' id='idEvalRetro' value='" +
                            ide + "'>");
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
                    } else {
                        swal({
                            title: "Libro de Calificaciones",
                            text: "Esta Evaluación no ha sido Calificada.",
                            icon: "warning",
                            button: "Aceptar",
                        });
                    }



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
                    $("#ListCal").show();
                },
                MostArc: function(id) {
                    
                    window.open($('#RutaUrl').data("ruta") + "/app-assets/Archivos_EvaluacionTaller/" +
                    $('#' + id).data("archivo"), '_blank');
                },
                VerArchResp: function(id) {
                    window.open($('#Respdattaller').data("ruta") + "/" + $('#' + id).data("archivo"),
                        '_blank');
                }
            })

        });
    </script>
@endsection
