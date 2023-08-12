@extends('Plantilla.Principal')
@section('title','Asignaturas')
@section('Contenido')
<div class="jumbotron jumbotron-fluid">
    <div class="container" >
        <div class="jumbo-heading" data-aos="fade-down">
            <h1 style="font-size: 30px;">  {{$NomCom.' -  Grado '.$Grado.'°'}} </h1>
        </div>
    </div>
    <!-- /container -->
</div><br>



<div class="container-fluid bg-primary block-padding pattern2 pt-lg-0">
    <h2 class="text-light text-center">Asignaturas</h2>
    <!-- image  -->
    <div class="container">
        <div class="carousel-3items owl-carousel owl-theme col-lg-12">
            <!-- service 1  -->

            @foreach($Asignaturas as $Modu)
            <div class="serviceBox2">
                <!-- service icon -->
                <div class="service-icon">
                    @php 
                    $active="1";
                    @endphp 
                    @foreach($imgmodulo as $img)
                    @if($active=="1")
                   
                    @if ($Modu->id == $img->modulo_img) 
                
                    <a href="#">
                        <img src="{{Session::get('URL').'/app-assets/images/Img_Modulos/'.$img->url_img}}" alt="" class="blob img-fluid">
                    </a>
                     @php 
                    $active="2";
                    @endphp 
                    @endif
                    @php 
                   
                    @endphp 
                    @endif
                    @endforeach  
                </div>
                <!-- service content -->
                <div class="service-content">
                    <a href="services-single.html">
                        <h5 class="service-head">{!!   $Modu->nombre  !!}</h5>
                    </a>
                    <p style="text-align:justify;">
                        {!!  substr($Modu->presentacion_modulo, 0, 200).'...'   !!}
                    </p>
                    <!-- Button -->	 
                    <a href="{{url('/Contenido/PresentacionCont/'.$Modu->id.'/'.$Est)}}" class="btn btn-quaternary  btn-sm mt-2 ml-1">Entrar</a>
                </div>
            </div>

            @endforeach                          


        </div>
        <!-- /owl-services -->
    </div>
    <!-- /container -->
</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $("#Men_Tablero").removeClass("nav-item active");
        $("#Men_AsigEst").addClass("nav-item active");
        $.extend({

            AbrirTema: function (idrut, id) {
                var url = $('#' + idrut).data("ruta");
                location.href = url + '/' + id;
            },
            MostActEval: function (id) {
                var url = $('#' + id).data("ruta");
                location.href = url;
                ;
            }
        });


    });
</script>
@endsection