@extends('Plantilla.Principal')
@section('title','Inicio')
@section('Contenido')
<div class="container">
    <section id="intro-cards" id="ListAsig" class="row pattern2 pt-lg-0">
        <!-- card 1 -->  
        @foreach($Asignatura as $Asig)
        <div class="col-lg-4" style="padding: 15px;"  data-aos="zoom-out">
            <div class="card card-flip ">
                <!-- front of card  -->  
                <div class="card bg-secondary text-light ">
                    <div class="p-5" style="padding: 2rem !important ">
                        <h6 class="card-title text-light">{!! $Asig->nombre !!}</h6>

                        <!-- button show on mobile only,where flip is disabled -->
                        <a href="{{url('/Contenido/GradosxAsignaturaDoc/'.$Asig->id)}}" class="btn d-lg-none">Entrar</a>
                    </div>
                    <!-- /p-5 -->
                    <!-- image -->

                    @foreach($imgAsig as $img)
                    @if($Asig->id==$img->asig_img)
                    <img class="card-img"  src="{{Session::get('URL').'/app-assets/images/Img_Asinaturas/'.$img->url_img}}" alt="">
                    @break;
                    @endif
                    @endforeach 
                </div>
                <!-- /card -->
                <!-- back of card -->
                <div class="card bg-secondary text-light card-back">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div class="p-4">
                            <div style="height: 190px;overflow: auto;">
                                <p class="card-text" style="text-align: justify;font-size:12px;  ">{!! substr($Asig->descripcion, 0, 400).'...'    !!}
                                </p>
                            </div>

                            <!-- button -->
                            <a href="{{url('/Contenido/GradosxAsignaturaDoc/'.$Asig->id)}}" class="btn">Entrar</a>
                        </div>
                        <!-- /p-4 -->
                    </div>

                    <!-- /card-body -->
                </div>

                <!-- /card -->
            </div>
            <!--/col-lg -->
        </div>

        @endforeach
    </section>

    <div class="section-heading text-center">
        <h2>Módulos Transversales</h2>
        <p class="subtitle">Módulos de Formación y Orientación</p>
    </div>

    <section id="intro-cardsM"  class="row pattern2 pt-lg-0">
        <!-- card 1 -->  
        @foreach($Modulos as $Asig)
        <div class="col-lg-4" style="padding: 15px;"  data-aos="zoom-out">
            <div class="card card-flip ">
                <!-- front of card  -->  
                <div class="card bg-secondary text-light ">
                    <div class="p-5" style="padding: 2rem !important ">
                        <h6 class="card-title text-light">{!! $Asig->nombre !!}</h6>

                        <!-- button show on mobile only,where flip is disabled -->
                        <a href="{{url('/Contenido/GradosxModulosDoc/'.$Asig->id)}}" class="btn d-lg-none">Entrar</a>
                    </div>
                    <!-- /p-5 -->
                    <!-- image -->

                    @foreach($imgmodulo as $img)
                    @if($Asig->id==$img->asig_img)
                    <img class="card-img"  src="{{Session::get('URL').'/app-assets/images/Img_ModulosTransv/'.$img->url_img}}" alt="">
                    @break;
                    @endif
                    @endforeach 
                </div>
                <!-- /card -->
                <!-- back of card -->
                <div class="card bg-secondary text-light card-back">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div class="p-4">
                            <div style="height: 190px;overflow: auto;">
                                <p class="card-text" style="text-align: justify;font-size:12px;  ">{!! substr($Asig->descripcion, 0, 400).'...'    !!}
                                </p>
                            </div>

                            <!-- button -->
                            <a href="{{url('/Contenido/GradosxModulosDoc/'.$Asig->id)}}" class="btn">Entrar</a>
                        </div>
                        <!-- /p-4 -->
                    </div>

                    <!-- /card-body -->
                </div>

                <!-- /card -->
            </div>
            <!--/col-lg -->
        </div>

        @endforeach
    </section>
    

</div>

@endsection