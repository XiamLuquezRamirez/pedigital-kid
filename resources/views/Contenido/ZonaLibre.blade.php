@extends('Plantilla.Principal')
@section('title','Zona Libre')
@section('Contenido')
<input type="hidden" class="form-control" id="RutArcZonL" data-ruta="{{Session::get('URL')."/app-assets/Archivos_Contenidos"}}"/>
<input type="hidden" class="form-control" id="RutAniZonL" data-ruta="{{Session::get('URL')."/app-assets/Contenido_Didactico"}}"/>
<div class="jumbotron jumbotron-fluid">
    <div class="container" >
        <div class="jumbo-heading" data-aos="fade-down">
            <h1 style="font-size: 30px;">ZONA LIBRE</h1>
        </div>
    </div>
    <!-- /container -->
</div>
<div class="container block-padding" style="padding-top: 40px;">
    <!-- row starts -->
    <div class="row">
        <div class="comment row">
            <div class="col-md-3 col-xs-12 comment-img text-center float-left">
                <img class="rounded-circle img-fluid m-x-auto" src="{{Session::get('URL').'/app-assets/images/Img_Docentes/'.$DatDoce->foto}}" alt="">
            </div>
            <!-- /col-md -->
            <div class="col-md-9 col-xs-12  float-right">
                <h6 style="text-transform: capitalize;margin-bottom: 0px;" class="mt-2"><a href="">{{$DatDoce->nombre.' '.$DatDoce->apellido}}</a> </h6>
                <p>Docente Asignado.</p>
            </div>
            <!--/media-body -->
        </div>
        <!-- /col-lg -->
    </div>
    <!-- /row -->
    <div class="mt-0">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <!-- navigation -->
                <div class="tabs-with-icon">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @php  
                            $j=1;
                            $ClaseCom = "active show";
                            @endphp 
                            @if($TamCom>0)
                            <a class="nav-item nav-link {{$ClaseCom}}" id="tab1-tab" data-toggle="tab" href="#tab1"><i class="flaticon-classroom"></i>Comentarios </a>
                            @php  
                            $ClaseCom = "";
                            @endphp 
                            @endif

                            @if($TamTem>0)
                            <a class="nav-item nav-link {{$ClaseCom}}" id="tab2-tab" data-toggle="tab" href="#tab2"><i class="flaticon-teacher"></i>Contenido Tematico</a>
                            @php  
                            $ClaseCom = "";
                            @endphp 
                            @endif

                            @if($TamVid>0)
                            <a class="nav-item nav-link {{$ClaseCom}}" id="tab3-tab" data-toggle="tab" href="#tab3"><i class="flaticon-books-stack-of-three"></i>Archivos Subidos</a>
                            @php  
                            $ClaseCom = "";
                            @endphp 
                            @endif
                            @if($TamArc>0)
                            <a class="nav-item nav-link {{$ClaseCom}}" id="tab4-tab" data-toggle="tab" href="#tab4"><i class="flaticon-blackboard"></i>Videos Subidos</a>
                            @php  
                            $ClaseCom = "";
                            @endphp 
                            @endif

                            @if($TamLin>0)
                            <a class="nav-item nav-link {{$ClaseCom}}" id="tab5-tab" data-toggle="tab" href="#tab5"><i class="flaticon-block-with-letters"></i>Links Subidos</a>
                            @php  
                            $ClaseCom = "";
                            @endphp 
                            @endif
                        </div>
                    </nav>
                    <!-- tab-content -->
                    <div class="tab-content block-padding" id="nav-tabContent">
                        @php  
                        $ClasePanel = "active show";
                        @endphp 
                        @if($TamCom>0)
                       
                        <div class="tab-pane {{$ClasePanel}}" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                            <!-- row -->
                            <div class="row" >
                                @foreach($Temas as $Tem)
                                @if($Tem->tip_contenido=="COMENTARIO")
                                @foreach($Comentarios as $Coment)
                                @if($Tem->id==$Coment->contenido)
                                <div class="col-lg-6">
                                    <div class="owl-item active" style="padding-top: 15px;"><div class="testimonial">
                                            <div class="content">
                                                <p class="description">
                                                    {!!$Coment->cont_comentario!!}                      
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach   
                                @endif
                                @endforeach   
                            </div>
                            <!-- row -->
                        </div>
                        @php  
                        $ClasePanel = "";
                        @endphp 
                        @endif

                        <!-- ./Tab-pane -->
                        @if($TamTem>0)
                        <div class="tab-pane {{$ClasePanel}}" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                            <div class="row" id="ListDoc">
                                @foreach($Temas as $Tem)
                                @if($Tem->tip_contenido=="DOCUMENTO")
                                <div class="col-md-6 col-lg-6 " style="padding-top: 15px;cursor: pointer;" onclick="$.MostCont({{$Tem->id}});">
                                    <!-- feature -->
                                    <div class="feature-with-icon">
                                        <div class="icon-features">
                                            <!-- icon -->
                                            <i class="flaticon-open-book-1 text-primary"></i>
                                        </div>
                                        <h5 style="text-transform: capitalize;">{{$Tem->titu_contenido}}</h5>
                                    </div>
                                    <!-- /feature-with-icon-->
                                    <!-- feature -->

                                    <!-- /feature-with-icon-->
                                </div>
                                @endif
                                @endforeach  
                            </div>
                            <div class="row" id="DetDocu" style="display: none;">
                                <div class="notepad mt-5 aos-init aos-animate" data-aos="zoom-out">
                                    <div class="row">

                                        <div class="col-lg-12" id="ContDoc" style="height: 400px; overflow-y: scroll;">

                                        </div>
                                        <div class="col-lg-12" style="text-align: right;">
                                            <button type="button" onclick="$.AtraConDoc();" class="btn btn-info">Atras</button>
                                        </div>
                                        <!-- /col-lg-->
                                    </div>
                                    <!-- /row -->
                                </div>
                            </div>
                            <!-- row -->
                        </div>
                        @php  
                        $ClasePanel = "";
                        @endphp 
                        @endif
                        <!-- ./Tab-pane -->

                        @if($TamVid>0)
                        <div class="tab-pane {{$ClasePanel}}" id="tab3" role="tabpanel" aria-labelledby="tab4-tab">
                            <div class="row" id="ListVideos">
                                @foreach($Temas as $Tem)
                                @if($Tem->tip_contenido=="VIDEOS")
                                <div class="col-md-6 col-lg-6" style="padding-top: 15px;cursor: pointer;" onclick="$.MostVideos({{$Tem->id}});">
                                    <!-- feature -->
                                    <div class="feature-with-icon">
                                        <div class="icon-features">
                                            <!-- icon -->
                                            <i class="flaticon-open-book-1 text-primary"></i>
                                        </div>
                                        <h5 style="text-transform: capitalize;">{{$Tem->titu_contenido}}</h5>
                                    </div>
                                    <!-- /feature-with-icon-->
                                    <!-- feature -->

                                    <!-- /feature-with-icon-->
                                </div>
                                @endif
                                @endforeach  
                            </div>
                            <div style="display: none;" id="DetlistVideos">


                            </div>


                            <div id="VerVideo">
                                <div class="col-md-12 col-lg-12">
                                    <div id='DetAnimaciones'  style="height: 400px;  overflow: auto;display: none;">
                                        <video id="videoclipAnima" width="100%" height="360" controls="controls" title="Video title">
                                            <source id="mp4videoAnima" src="" type="video/mp4"  />
                                        </video>
                                        <div class="col-lg-12" style="text-align: right;padding-bottom: 15px;">
                                            <button type="button" onclick="$.AtraVidArc();" class="btn btn-info">Atras</button>
                                        </div>
                                    </div>
                                    <div id='DetLinkVideo'  style="display: none;height: 400px; width: 100%; padding-top: 15px;">
                                        <iframe id="LinkVideo" width="100%" height="100%" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        <div class="col-lg-12" style="text-align: right;padding-bottom: 15px;">
                                            <button type="button" onclick="$.AtraVidLink();" class="btn btn-info">Atras</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- row -->
                        </div>
                        @php  
                        $ClasePanel = "";
                        @endphp 
                        @endif
                        @if($TamArc>0)
                        <div class="tab-pane {{$ClasePanel}}" id="tab4" role="tabpanel" aria-labelledby="tab3-tab">
                            <div class="row">
                                @foreach($Temas as $Tem)
                                @if($Tem->tip_contenido=="ARCHIVO")
                                <div class="col-md-6 col-lg-6" style="padding-top: 15px;cursor: pointer;" onclick="$.MostArchi({{$Tem->id}});">
                                    <!-- feature -->
                                    <div class="feature-with-icon">
                                        <div class="icon-features">
                                            <!-- icon -->
                                            <i class="flaticon-open-book-1 text-primary"></i>
                                        </div>
                                        <h5 style="text-transform: capitalize;">{{$Tem->titu_contenido}}</h5>
                                    </div>
                                    <!-- /feature-with-icon-->
                                    <!-- feature -->

                                    <!-- /feature-with-icon-->
                                </div>
                                @endif
                                @endforeach  
                            </div>
                            <!-- row -->
                        </div>
                        @php  
                        $ClasePanel = "";
                        @endphp 
                        @endif
                        <!-- ./Tab-pane -->
                        
                        <!-- ./Tab-pane -->
                        @if($TamLin>0)
                        <div class="tab-pane {{$ClasePanel}}" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                            <div class="row" id="ListLinks">
                                @foreach($Temas as $Tem)
                                @if($Tem->tip_contenido=="LINK")
                                <div class="col-md-6 col-lg-6" style="padding-top: 15px;cursor: pointer;" onclick="$.AbrirLink({{$Tem->id}});">
                                    <!-- feature -->
                                    <div class="feature-with-icon">
                                        <div class="icon-features">
                                            <!-- icon -->
                                            <i class="flaticon-open-book-1 text-primary"></i>
                                        </div>
                                        <h5 style="text-transform: capitalize;">{{$Tem->titu_contenido}}</h5>
                                    </div>

                                </div>
                                @endif
                                @endforeach 
                            </div>

                            <div style="display: none;" id="DetlistLinks">


                            </div>

                            <div id='DetLink'  style="display: none;height: 400px; width: 100%; padding-top: 15px;">
                                <iframe id="Link" width="100%" height="100%" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                <div class="col-lg-12" style="text-align: right;padding-bottom: 15px;">
                                    <button type="button" onclick="$.AtraLink();" class="btn btn-info">Atras</button>
                                </div>
                            </div>


                            <!-- row -->
                        </div>
                        @php  
                        $ClasePanel = "";
                        @endphp 
                        @endif
                        <!-- ./Tab-pane -->
                    </div>
                    <!-- ./Tab-content -->
                </div>
                <!-- vertical-tabs -->
            </div>
            <!-- /col-lg-6 -->
        </div>
        <!-- /row --> 
    </div>
    <!-- /mt-5 -->	 

</div>

{!! Form::open(['url'=>'/cambiar/ContenidoDocumentoLibre'
,'id'=>'formContenidoDocumento'])!!}
{!! Form::close() !!}


{!! Form::open(['url'=>'/cambiar/ContenidoArchZona'
,'id'=>'formContenidoArch'])!!}
{!! Form::close() !!}


{!! Form::open(['url'=>'/Consultar/ContenidoAnimZonaLibre'
,'id'=>'formConsuAnim'])!!}
{!! Form::close() !!}


{!! Form::open(['url'=>'/Consultar/ContenidoLinkZonaLibre'
,'id'=>'formConsuLink'])!!}
{!! Form::close() !!}



@endsection
@section('scripts')
<script>
    $(document).ready(function () {
    $("#Men_Tablero").removeClass("nav-item active");
    $("#Men_ZonaLibre").addClass("nav-item active");
    $.extend({

    MostCont: function (id) {
    $("#DetDocu").show();
    $("#ListDoc").hide();
    var form = $("#formContenidoDocumento");
    $("#idTema").remove();
    form.append("<input type='hidden' name='id_tema' id='idTema' value='" + id + "'>");
    var url = form.attr("action");
    var datos = form.serialize();
    $.ajax({
    type: "POST",
            url: url,
            data: datos,
            dataType: "json",
            success: function (respuesta) {
            $("#ContDoc").html(respuesta.DesaTema.cont_documento);
            }
    });
    },
            MostArchi : function(id){
            var form = $("#formContenidoArch");
            $("#idTema").remove();
            form.append("<input type='hidden' name='id_tema' id='idTema' value='" + id + "'>");
            var url = form.attr("action");
            var datos = form.serialize();
            $.ajax({
            type: "POST",
                    url: url,
                    data: datos,
                    dataType: "json",
                    success: function (respuesta) {
                    window.open($('#RutArcZonL').data("ruta") + "/" + respuesta.DesArch.nom_arch, '_blank');
                    }
            });
            },
            MostVideos: function (id) {
            $("#ListVideos").hide();
            $("#DetlistVideos").show();
            var form = $("#formConsuAnim");
            var contenido = '<div class="list-group" style="padding-top: 15px" >';
            $("#TemaAni").remove();
            form.append("<input type='hidden' name='TemaAni' id='TemaAni' value='" + id + "'>");
            var url = form.attr("action");
            var datos = form.serialize();
            var j = 1;
            $.ajax({
            type: "POST",
                    url: url,
                    data: datos,
                    dataType: "json",
                    success: function (respuesta) {
                    $.each(respuesta.DesAnim, function (i, item) {
                    if (respuesta.tip_video === "LINK") {
                    contenido += '<a style="cursor: pointer;color:#035392;" class="list-group-item list-group-item-action" onclick="$.MostVideoLink(this.id)" id="' + item.id + '"  data-archivo="' + item.url + '" ><i class="fab fa-youtube"></i> ' + item.titulo + '</a>';
                    } else {
                    contenido += '<a style="cursor: pointer;color:#035392;" class="list-group-item list-group-item-action" onclick="$.MostAnim(this.id)" id="' + item.id + '"  data-archivo="' + item.cont_didactico + '" > <i class="fab fa-youtube"></i> ' + item.titulo.slice(0, - 4) + '</a>';
                    }

                    j++;
                    });
                    contenido += '</div><div class="col-lg-12" style="text-align: right;padding-bottom: 15px;">'
                            + ' <button type="button" onclick="$.AtraListVidLink();" class="btn btn-info">Atras</button>'
                            + '  </div>';
                    $("#DetlistVideos").html(contenido);
                    }
            });
            },
            AbrirLink: function (id) {
            $("#ListLinks").hide();
            $("#DetlistLinks").show();
            var form = $("#formConsuLink");
            var contenido = '<div class="list-group" style="padding-top: 15px" >';
            $("#TemaAni").remove();
            form.append("<input type='hidden' name='TemaAni' id='TemaAni' value='" + id + "'>");
            var url = form.attr("action");
            var datos = form.serialize();
            var j = 1;
            $.ajax({
            type: "POST",
                    url: url,
                    data: datos,
                    dataType: "json",
                    success: function (respuesta) {
                    $.each(respuesta.DesLink, function (i, item) {
                    contenido += '<a style="cursor: pointer;color:#035392;" class="list-group-item list-group-item-action" onclick="$.MostLink(this.id)" id="' + item.id + '"  data-archivo="' + item.url + '" > <strong>' + item.titulo + '</strong></a>';
                    j++;
                    });
                    contenido += '</div><div class="col-lg-12" style="text-align: right;padding-bottom: 15px;">'
                            + ' <button type="button" onclick="$.AtraListLink();" class="btn btn-info">Atras</button>'
                            + '  </div>';
                    $("#DetlistLinks").html(contenido);
                    $("#titu_temaAnim").html(respuesta.TitTema);
                    }
            });
            },
            AtraConDoc: function(){
            $("#DetDocu").hide();
            $("#ListDoc").show();
            },
            AtraVidLink: function(){
            $("#DetLinkVideo").hide();
            $("#DetlistVideos").show();
            },
            AtraVidArc: function(){
            $("#DetAnimaciones").hide();
            $("#DetlistVideos").show();
            },
            AtraListVidLink: function(){
            $("#DetlistVideos").hide();
            $("#ListVideos").show();
            },
            AtraListLink: function(){
            $("#DetlistLinks").hide();
            $("#ListLinks").show();
            },
            AtraLink: function(){
            $("#DetLink").hide();
            $("#DetlistLinks").show();
            },
            MostVideoLink: function (id) {

            $("#DetLinkVideo").show();
            $("#DetlistVideos").hide();
            var nomarchi = $('#' + id).data("archivo");
            nomarchi = nomarchi.replace("watch?v", "embed/");
            $('#LinkVideo').attr('src', nomarchi);
            },
            MostAnim: function (id) {
            $("#DetAnimaciones").show();
            $("#DetlistVideos").hide();
            var videoID = 'videoclipAnima';
            var sourceID = 'mp4videoAnima';
            var nomarchi = $('#' + id).data("archivo");
            var newmp4 = $('#RutAniZonL').data("ruta") + "/" + nomarchi;
            $('#' + videoID).get(0).pause();
            $('#' + sourceID).attr('src', newmp4);
            $('#' + videoID).get(0).load();
            $('#' + videoID).get(0).play();
            },
            MostLink: function (id) {
            $("#DetLink").show();
            $("#DetlistLinks").hide();
            var nomarchi = $('#' + id).data("archivo");
            $('#Link').attr('src', nomarchi);
            }
    });
    });
</script>
@endsection