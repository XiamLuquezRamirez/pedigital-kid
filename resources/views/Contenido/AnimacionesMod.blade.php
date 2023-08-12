@extends('Plantilla.Principal')
@section('title','Animaciones')
@section('Contenido')
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" class="form-control" id="RutContDid" data-ruta="{{ Session::get('URL') }}/app-assets/Contenido_DidacticoModulos"/>
<input type="hidden" class="form-control" id="RutaUrl" data-ruta="{{ Session::get('URL') }}"/>
<div class="jumbotron jumbotron-fluid">
    <div class="container" >
        <div class="jumbo-heading" data-aos="fade-down">
            <h1 style="font-size: 30px;">  {{$NomCom.' - '.$NomAsig.' Grado '.$Grado.'°'}} </h1>
        </div>
    </div>
    <!-- /container -->
</div>
<div class="container-fluid block-padding" style="padding-top: 40px; ">
    <div class="container block-padding ">
        <div class="row">
            <h3 class="text-center">{{$Temas->titu_contenido}}</h3>
        </div>

        <div class="widget-area notepad">
            <h5 class="sidebar-header">Animaciones</h5>
            <div class="list-group" id="Div_ListAnima">
                @foreach($Anima as $Anim)
                <a href='javascript:void(0)' onclick="$.AbrirAnima(this.id);" style="text-transform: capitalize;" data-archivo="{{ $Anim->cont_didactico }}" id="{{ $Anim->id }}"  class="list-group-item list-group-item-action btn_eva"><i class="flaticon-blackboard"></i>
                    {{substr($Anim->titulo,0,-4)}}
                </a>
                @endforeach

            </div>
            <div class="list-group" id="Div_DetAnima" style="display: none;">

                <div class="col-md-12">
                    <div class="row">
                        <!-- contact-info-->
                        <div class="contact-info col-lg-12">
                            <video id="videoclipAnima" width="100%" height="360" controls="controls" title="Video title">
                                <source id="mp4videoAnima" src="" type="video/mp4"  />
                            </video>
                        </div>

                    </div>
                </div>
            </div>
            <a class="custom-link float-right mt-5" id="Btn_AtraTema" href="{{url('/Contenido/VerTemasMod/'.Session::get('IDTEMA'))}}">Atras</a>
            <a class="custom-link float-right mt-5" id="Btn_AtraAnim" onclick="$.AtrasAnim();"  style="display: none;" href="javascript:void(0)">Atras</a>
            <!-- /list-group -->
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $("#Men_Tablero").removeClass("nav-item active");
        $("#Men_Presentacion").addClass("nav-item active");

        $.extend({

            AbrirAnima: function (id) {
                $("#Div_ListAnima").hide();
                $("#Div_DetAnima").show();
                $("#Btn_AtraTema").hide();
                $("#Btn_AtraAnim").show();

                var videoID = 'videoclipAnima';
                var sourceID = 'mp4videoAnima';
                var nomarchi = $('#' + id).data("archivo");
                var newmp4 = $('#RutContDid').data("ruta") + "/" + nomarchi;
                $('#' + videoID).get(0).pause();
                $('#' + sourceID).attr('src', newmp4);
                $('#' + videoID).get(0).load();
                $('#' + videoID).get(0).play();
            },
            AtrasAnim: function () {
                $("#Div_ListAnima").show();
                $("#Div_DetAnima").hide();
                $("#Btn_AtraTema").show();
                $("#Btn_AtraAnim").hide();
            }

        });
    });

</script>
@endsection