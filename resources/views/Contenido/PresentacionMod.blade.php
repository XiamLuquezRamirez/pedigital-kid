@extends('Plantilla.Principal')
@section('title', 'Presentación Módulos Transversales')
@section('Contenido')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="jumbo-heading" data-aos="fade-down">
                <h1 style="font-size: 30px;">
                    {{ $NomCom . ' - ' . $Asig->nombre . ' Grado ' . $Modulos->grado_modulo . '°' }} </h1>
            </div>
        </div>
        <!-- /container -->
    </div>
    <input type="hidden" class="form-control" id="Tip_Usu" value="{{ Auth::user()->tipo_usuario }}" />
    <input type="hidden" class="form-control" id="Ruta" value="{{ url('/') }}/" />
    <div class="container block-padding" style="padding-top: 40px;">
        <!-- row starts -->
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion">
                    <!-- collapsible accordion 1 -->
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                                Presentación y Objetivo
                            </a>
                        </div>
                        <!-- /card-header -->
                        <div id="collapseOne" class="collapse" data-parent=".accordion" style="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>Presentación</h3>
                                        <span class="h5 mt-3"> {{ $Modulos->objetivo_modulo }}</span>
                                    </div>
                                    <!-- /col-lg-->
                                    <div class="col-lg-6">
                                        <h3>Objetivo</h3>
                                        <span class="h5 mt-3">{{ $Modulos->presentacion_modulo }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- /col-lg -->
        </div>
        <!-- /row -->
        <div class="mt-5">
            <!-- row -->

            <div class="row">
                <div class="col-lg-12">
                    <!-- navigation -->
                    <div class="tabs-with-icon">
                        <nav>
                            <div  class="nav nav-tabs" id="nav-tab" role="tablist">
                                @php
                                    $active = 'active';
                                    $i = 1;
                                    $id = 'tab' . $i . '-tab';
                                @endphp

                                @foreach ($Periodo as $Peri)
                                    <a class="nav-item nav-link {{ $active }}" id="{{ $id }}"
                                        data-toggle="tab" role="tab"  aria-selected="true" href="#tab{{ $i }}"><i
                                            class="flaticon-books-stack-of-three"></i>{{ $Peri->des_periodo }}</a>
                                    @php
                                        $active = '';
                                        $i++;
                                    @endphp
                                @endforeach
                            </div>
                        </nav>
                        <!-- tab-content -->
                        
                        <div class="tab-content block-padding" id="nav-tabContent">
                            @php
                                $active = 'show active';
                                $i = 1;
                                $id = 'tab' . $i . '-tab';
                            @endphp

                            @php
                                $j = 1;
                            @endphp

                            @foreach ($Periodo as $Peri)
                                <div class="tab-pane fade {{ $active }}" id="tab{{ $i }}" role="tabpanel"
                                    aria-labelledby="{{ $id }}">
                                    <!-- row -->

                                    @foreach ($Unidad as $Uni)
                                        @if ($Peri->id == $Uni->periodo)

                                            <div class="accordion">
                                                <!-- collapsible accordion 1 -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <a class="card-link" data-toggle="collapse"
                                                            href="#Unidad{{ $Uni->id }}">
                                                            {{ $Uni->nom_unidad }}: {{ $Uni->des_unidad }}
                                                        </a>
                                                    </div>
                                                    <!-- /card-header -->
                                                    @php
                                                        $ClaseCom = ['alert-primary', 'alert-secondary', 'alert-success', 'alert-danger', 'alert-warning', 'alert-info', 'alert-light', 'alert-dark'];
                                                    @endphp
                                                    <div id="Unidad{{ $Uni->id }}" class="collapse"
                                                        data-parent=".accordion">
                                                        <div class="card-body">
                                                            @foreach ($Temas as $Tem)
                                                                @if ($Tem->unidad == $Uni->id)
                                                                    @php
                                                                        $color = $ClaseCom[array_rand($ClaseCom)];
                                                                        if ($Tem->habilitado_doc == null) {
                                                                            $habi = 'NO';
                                                                        } else {
                                                                            $habi = $Tem->habilitado_doc;
                                                                        }

                                                                        if($Tem->ocultar_doc == null || $Tem->ocultar_doc == ""|| $Tem->ocultar_doc == "SI"){
                                                                            $mostrar="block"; 
                                                                        }else if($Tem->ocultar_doc =="NO"){
                                                                            $mostrar="none"; 
                                                                        }

                                                                    @endphp
                                                                    <input type='hidden' id="TemHabi{{ $Tem->id }}"
                                                                        value="{{ $habi }}">
                                                                    <div class="alert {{ $color }} hvr-grow-shadow" style="display: {{$mostrar}}"
                                                                        onclick="$.MostConteDoc('{{ $Tem->id }}')" ;
                                                                        style="cursor: pointer; width: 100%;" role="alert">
                                                                        {{ $Tem->titu_contenido }}
                                                                    </div>
                                                                    @php
                                                                        $j++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif


                                    @endforeach
                                    <!-- row -->
                                </div>
                                <?php
                                $active = '';
                                $i++;
                                ?>
                            @endforeach

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
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#Men_Tablero").removeClass("nav-item active");
            $("#Men_Presentacion").addClass("nav-item active");
            $.extend({

                MostConteDoc: function(id) {
                    if ($("#TemHabi" + id).val() === "SI" || $("#Tip_Usu").val() !== "Estudiante") {
                        var rurl = $("#Ruta").val();
                        $(location).attr('href', rurl +
                            "/Contenido/VerTemasMod/" + id)
                    } else {
                        mensaje = "Este Tema no ha sido Habilitado por el Docente Encargado.";
                        swal({
                            title: "",
                            text: mensaje,
                            icon: "warning",
                            button: "Aceptar",
                        });
                    }
                }
            });


        });
    </script>
@endsection
