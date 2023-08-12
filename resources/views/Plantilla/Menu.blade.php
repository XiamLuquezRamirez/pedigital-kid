<nav id="main-nav" class="navbar-expand-xl fixed-top">
    <div class="row">
        <!-- Start Top Bar -->
        <div class="container-fluid top-bar">

            <!-- /container -->
        </div>
        <!-- End Top bar -->
        <!-- Navbar Starts -->
        <div class="navbar container-fluid">
            <div class="container" style="max-width: 100%;">
                <!-- logo -->
                <a class="nav-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="" class="img-fluid">
                </a>
                <!-- Navbar toggler -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggle-icon">
                        <i class="fas fa-bars"></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        @if(Session::get('IDUSU')=='')
                        <li id="Men_Tablero" class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}">
                                <i class="fa fa-home"></i> Inicio
                            </a>
                        </li>
                        @endif
                        @if(Session::get('IDGRADO')!='')
                        @if(Session::get('TIPCONT')=='ASI')
                        <li id="Men_Presentacion" class="nav-item">
                            <a class="nav-link" href="{{url('/Contenido/PresentacionCont/'.Session::get('IDGRADO').'/'.Session::get('IDUSU'))}}" id="services-dropdown"  aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon-classroom"></i>    Desarrollo Temático
                            </a>
                        </li>
                        @else
                        <li id="Men_Presentacion" class="nav-item">
                            <a class="nav-link" href="{{url('/Contenido/PresentacionContMod/'.Session::get('IDGRADO').'/'.Session::get('IDUSU'))}}" id="services-dropdown"  aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon-classroom"></i>    Desarrollo Temático
                            </a>
                        </li>
                        @endif
                        @if(Session::get('NLABO')>0)
                        <li id="Men_Laboratorio" class="nav-item">
                            <a class="nav-link" href="{{url('/Contenido/Laboratorios/'.Session::get('IDGRADO'))}}" id="services-dropdown"  aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-flask"></i>  Laboratorios
                            </a>
                        </li>
                        @endif
                        @if(Session::get('TIPCONT')=='ASI')
                        <li id="Men_Califica" class="nav-item">
                            <a class="nav-link" href="{{url('/Contenido/Calificaciones/'.Session::get('IDGRADO').'/'.Session::get('IDUSU'))}}" id="services-dropdown"  aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-certificate"></i>    Calificaciones
                            </a>
                        </li>
                        @else   
                        <li id="Men_Califica" class="nav-item">
                            <a class="nav-link" href="{{url('/Contenido/CalificacionesMod/'.Session::get('IDGRADO').'/'.Session::get('IDUSU'))}}" id="services-dropdown"  aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-certificate"></i>   Calificaciones
                            </a>
                        </li>
                        @endif
                        @endif

                        @if(Session::get('IDUSU')!='')
                        <li id="Men_Grados" class="nav-item">
                            <a class="nav-link" href="{{url('/Contenido/GradosxAsignatura/'.Session::get('IDASIG'))}}" id="services-dropdown"  aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon-cubes-1"></i> Grados
                            </a>
                        </li>
                        @if(Session::get('ZONALIBRE')=='SI')
                        <li id="Men_ZonaLibre"  class="nav-item">
                            <a class="nav-link" href="{{url('/Contenido/ZonaLibre/'.Session::get('IDUSU'))}}" id="services-dropdown"  aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon-teacher"></i> Zona Libre
                            </a>
                        </li>
                        @endif
                        @if(Session::get('PerModJ')=='si')
                        <li id="Men_ZonaPlay"  class="nav-item">
                            <a class="nav-link" href="{{url('/Contenido/ZonaPlay/'.Session::get('IDUSU'))}}" id="services-dropdown"  aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon-kids"></i> Zona Play
                            </a>
                        </li>
                        @endif
                        @if(Session::get('PerModE')=='si')
                        <li id="Men_moduloE"  class="nav-item">
                            <a class="nav-link" href="{{url('/Contenido/moduloE/'.Session::get('IDUSU'))}}" id="services-dropdown"  aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon-teacher"></i> Módulo E
                            </a>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" style="text-transform: capitalize;" href="#" id="others-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i>   {{ Session::get('NOMBREST') }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="others-dropdown">
                                <a class="dropdown-item" href="{{url('/logout')}}">
                                    <i class="fa fa-arrow-left"></i>    Cerrar Sessión</a>

                            </div>
                        </li>
                        @endif
                    </ul>
                </div>

            </div>

        </div>
        <!-- /navbar -->
    </div>
    <!--/row -->
</nav>
