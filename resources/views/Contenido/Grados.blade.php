@extends('Plantilla.Principal')
@section('title', 'Grados Asignaturas')
@section('Contenido')

    <section  id="ListAsig" class="row pb-1" style="margin-left: 20px;margin-right: 20px;">

        <div class="container">
                <div class="row">       
                    @if (Session::has('error'))
                   
                        <div class="col-md-12">
                            <div class="alert alert-icon-right alert-warning alert-dismissible mb-2"
                                role="alert">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Alerta!</strong> {!! session('error') !!}

                            </div>

                        </div>
                    
                @endif
                    @foreach ($Asignatura as $Modu)
                        <div class="col-lg-4 res-margin" style="padding-bottom: 10px;">
                            <!-- blog-box -->
                            <div class="blog-box">
                                <!-- image -->
                                @foreach ($imgAsig as $img)
                                    @if ($Modu->id == $img->modulo_img)
                                        @if (Session::get('NOMBREST') != '')
                                            <a
                                                href="{{ url('/Contenido/PresentacionCont/' . $Modu->id . '/' . Auth::user()->id) }}">
                                            @else
                                                <a href="{{ url('/Contenido/GradosxEstud/' . $Modu->id) }}">
                                        @endif
                                        <div class="image"><img
                                                src="{{ Session::get('URL') . '/app-assets/images/Img_Modulos/' . $img->url_img }}"
                                                alt=""></div>
                                        </a>
                                    @endif
                                @endforeach

                                <!-- blog-box-caption -->
                                <div class="blog-box-caption">
                                    <!-- date -->
                                    <div class="date"><span
                                            class="day">{!! $Modu->grado_modulo . '°' !!}</span><span
                                            class="month">Grado</span></div>
                                        <a
                                            href="{{ url('/Contenido/PresentacionCont/' . $Modu->id . '/' . Auth::user()->id) }}">
                                    <h5>{!! $Modu->nombre . ' Grado ' . $Modu->grado_modulo . '°' !!}</h5>
                                    </a>
                                    <!-- /link -->
                                    <p>
                                        {!! Str::limit($Modu->objetivo_modulo, 50) . '...' !!}
                                    </p>
                                </div>
                                <!-- blog-box-footer -->
                                <div class="blog-box-footer">

                                    <!-- Button -->
                                    <div class="text-center col-md-12">
                                            <a href="{{ url('/Contenido/PresentacionCont/' . $Modu->id . '/' . Auth::user()->id) }}"
                                                class="btn btn-primary ">Entrar</a>
                                    </div>
                                </div>
                                <!-- /blog-box-footer -->
                            </div>
                            <!-- /blog-box -->
                        </div>
                    @endforeach
                </div>


    </section>

    @if (Session::get('PerModu') == 'si')

    <div class="section-heading text-center">
        <h2>Módulos Transversales</h2>
        <p class="subtitle">Módulos de Formación y Orientación</p>
    </div>

    <section id="intro-cardsM"   class="row pattern2 pt-lg-0">

        <div class="container">
                <div class="row">
                    @foreach ($Modulos as $Modu)
                        <div class="col-lg-4 res-margin" style="padding-bottom: 10px;">
                            <!-- blog-box -->
                            <div class="blog-box">
                                <!-- image -->
                                @foreach ($imgmodulo as $img)
                                    @if ($Modu->id == $img->modulo_img)
                                        @if (Session::get('NOMBREST') != '')
                                            <a
                                                href="{{ url('/Contenido/PresentacionContMod/' . $Modu->id . '/' . Auth::user()->id) }}">
                                            @else
                                                <a href="{{ url('/Contenido/GradosxEstud/' . $Modu->id) }}">
                                        @endif
                                        <div class="image"><img
                                                src="{{ Session::get('URL') . '/app-assets/images/Img_GradosModTransv/' . $img->url_img }}"
                                                alt=""></div>
                                        </a>
                                    @endif
                                @endforeach

                                <!-- blog-box-caption -->
                                <div class="blog-box-caption">
                                    <!-- date -->
                                    <div class="date"><span
                                            class="day">{!! $Modu->grado_modulo . '°' !!}</span><span
                                            class="month">Grado</span></div>
                                        <a
                                            href="{{ url('/Contenido/PresentacionContMod/' . $Modu->id . '/' . Auth::user()->id) }}">
                                    <h5>{!! $Modu->nombre . ' Grado ' . $Modu->grado_modulo . '°' !!}</h5>
                                    </a>
                                    <!-- /link -->
                                    <p>
                                        {!! Str::limit($Modu->objetivo_modulo, 50) . '...' !!}
                                    </p>
                                </div>
                                <!-- blog-box-footer -->
                                <div class="blog-box-footer">

                                    <!-- Button -->
                                    <div class="text-center col-md-12">
                                            <a href="{{ url('/Contenido/PresentacionContMod/' . $Modu->id . '/' . Auth::user()->id) }}"
                                                class="btn btn-primary ">Entrar</a>
                                    </div>
                                </div>
                                <!-- /blog-box-footer -->
                            </div>
                            <!-- /blog-box -->
                        </div>
                    @endforeach
                </div>


    </section>
    @endif

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#Men_Tablero").removeClass("nav-item active");
            $("#Men_Grados").addClass("nav-item active");
         

            $.extend({
                AbrirTema: function(idrut, id) {

                }
            });


        });
    </script>
@endsection
