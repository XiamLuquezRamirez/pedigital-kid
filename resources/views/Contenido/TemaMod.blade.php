@extends('Plantilla.Principal')
@section('title','Desarrollo del Tema')
@section('Contenido')
<div class="jumbotron jumbotron-fluid">
    <div class="container" >
        <div class="jumbo-heading" data-aos="fade-down">
            <h1 style="font-size: 30px;">  {{$NomCom.' - '.$NomAsig.' Grado '.$Grado.'°'}} </h1>
        </div>
    </div>
    <!-- /container -->
</div>
<div class="container block-padding" style="padding-top: 40px;">
    <!-- row starts -->
   
    <section id="features" class="bg-transparent pt-1">
        <div class="container">
            <!-- section heading -->  
            <div class="section-heading text-center">
                <h3>{{$Titulo}}</h3>
                <p class="subtitle">--- {{$TitUnidad}} ---</p>
            </div>
            <!-- /section-heading -->
            <!-- features -->
            <div class="row ">
                <div class="col-lg-12">
                    <div style="overflow-y: scroll; height: 450px; ">
                    @if($TipCont=="DOCUMENTO")
                    {!! $Contenido !!}
                    @elseif($TipCont=="ARCHIVO")
                    <div id="ListArc">
                        @php
                        $i=1;
                        @endphp

                    @foreach ($DesaTema as $Arc)
                    <div class="alert alert-info"  id="{{ $i }}" data-archivo="{{$Arc->nom_arch}}" data-ruta="{{ Session::get('URL') }}/app-assets/Archivos_Contenidos" style="cursor: pointer;" onclick="$.mostmodArch(this.id);" role="alert">
                        <i class="fa fa-paperclip mr-1"></i> {{ substr($Arc->nom_arch,0,-4) }}
                     </div>
                     @php
                     $i++;
                     @endphp

                    @endforeach
                  </div>
                  <div id='cont_archi' style="display: none;height: 400px; overflow: auto;">
                    <div id="div_arc">
                    </div>
                    <a class="custom-link float-right mt-5" href="#" onclick="$.AtrasArc();">Atras</a>
                    </div>

                     @else

                     <div id="ListArc">
                        @php
                        $i=1;
                        @endphp

                    @foreach ($DesaTema as $Arc)
                    <div class="alert alert-info"  id="{{ $i }}" data-archivo="{{$Arc->cont_didactico}}" data-ruta="{{ Session::get('URL') }}/app-assets/Contenido_Didactico" style="cursor: pointer;" onclick="$.MostVideArc(this.id);" role="alert">
                        <i class="fa fa-video mr-1"></i> {{ substr($Arc->titulo,0,-4) }}
                     </div>
                     @php
                     $i++;
                     @endphp

                    @endforeach
                  </div>

                  <div id='DetAnimaciones' style="height: 400px; overflow: auto;display: none;">
                    <video id="videoclipAnima" width="100%" height="360" controls="controls"
                        title="Video title">
                        <source id="mp4videoAnima" src="" type="video/mp4" />
                    </video>
                    <a class="custom-link float-right mt-5" href="#" onclick="$.AtrasVide();">Atras</a>

                </div>

                    @endif

                    </div>
                </div>

                <!-- /row -->
            </div>
            <div class="row">
                <div class="col-lg-2" style="text-align: left;padding-top: 25px;">
                    @if($Animac=='s')
                    <!--                    <ul class="social-list float-left list-inline">
                                            <li class="list-inline-item"><a  title="Animaciones" href="{{asset("/Animaciones/VerAnimacionesMod/".$Temas->id)}}"><i class="fa fa-video"></i></a></li>
                                        </ul>-->

                    <a href="{{asset("/Animaciones/VerAnimacionesMod/".$Temas->id)}}"><img src="{{asset('img/ornaments/animacion1.png')}}" style="height: 90px; width: 70px;" class="floating-whale2" alt=""></a>

                    @endif
                </div>
                <div class="col-lg-10" style="text-align: right;padding-top: 25px;">

                    @if($ActIni=='s')
                    <button type="button" data-ruta="{{asset("/Evaluaciones/ActEvalMod/".$Temas->id."/ACTINI")}}" onclick="$.MostActEval(this.id);" id="Btn_ActIni" class="btn btn-tertiary"> <i class="flaticon-teacher"></i> Actividad de Inicio</button>
                    @endif
                    @if($Produc=='s')
                    <button type="button" data-ruta="{{asset("/Evaluaciones/ActEvalMod/".$Temas->id."/PRODUC")}}" onclick="$.MostActEval(this.id);" id="Btn_Produc" class="btn-margin btn btn-quaternary ml-1"> <i class="flaticon-teacher"></i> Producción</button>
                    @endif
                </div>
            </div>
        </div>

        <!-- /container -->
    </section>

</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $("#Men_Tablero").removeClass("nav-item active");
        $("#Men_Presentacion").addClass("nav-item active");
        $.extend({
            AbrirTema: function (idrut, id) {
                var url = $('#' + idrut).data("ruta");
                location.href = url + '/' + id;
            },
            MostActEval: function (id) {
                var url = $('#' + id).data("ruta");
                location.href = url;
                ;
            },
            MostAnimaciones: function (id) {
                var url = $('#' + id).data("ruta");
                location.href = url;
                ;
            },
            mostmodArch: function(id) {
                var nomarchi=$('#' + id).data("archivo");
                var ext = nomarchi.substring(nomarchi.lastIndexOf("."));
                if(ext != ".jpg" && ext != ".png" && ext != ".gif" && ext != ".jpeg" && ext != ".pdf"){
                    window.open($('#' + id).data("ruta") + "/" +nomarchi,'_blank');
                }else{
                    $("#ListArc").hide();
                    $("#cont_archi").show();
                    $("#div_arc").html(
                        '<embed src="" type="application/pdf" id="embed_arch" width="100%" height="600px" />'
                    );
                    jQuery('#embed_arch').attr('src', $('#' + id).data("ruta") + "/" + nomarchi);
                }
            },
            AtrasArc: function(){
                $("#ListArc").show();
                $("#cont_archi").hide(); 
            },
            AtrasVide: function(){
                $("#ListArc").show();
                $("#DetAnimaciones").hide(); 
            },
            MostVideArc: function(id){
                $("#DetAnimaciones").show();
                $("#ListArc").hide();
                var videoID = 'videoclipAnima';
                var sourceID = 'mp4videoAnima';
                var nomarchi = $('#' + id).data("archivo");
                var newmp4 = $('#' + id).data("ruta") + "/" + nomarchi;
                $('#' + videoID).get(0).pause();
                $('#' + sourceID).attr('src', newmp4);
                $('#' + videoID).get(0).load();
                $('#' + videoID).get(0).play();

            },
        });


    });
</script>
@endsection