<!DOCTYPE html>
<html lang="en">
@include('Plantilla.Head')
<!-- ==== body starts ==== -->

<body id="top">
    <!-- Preloader -->
    <div id="preloader">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="preloader-logo">
                    <!-- spinner -->
                    <div class="spinner">
                        <div class="dot1"></div>
                        <div class="dot2"></div>
                    </div>
                </div>
                <!--/preloader logo -->
            </div>
            <!--/row -->
        </div>
        <!--/container -->
    </div>
    <!--/Preloader ends -->
    @if (Session::get('SLIDER') == '')
       @include('Plantilla.Slider')
    @endif
    <!-- /nav -->
    <!-- page wrapper starts -->
    <div id="page-wrapper">
        <!-- ==== Slider ==== -->
        @include('Plantilla.Menu')
        <!-- /container-fluid -->
        <!-- ==== Page Content ==== -->

        <!-- section -->
        @yield('Contenido')

        <!-- #intro-cards -->

        <!-- /container -->
        <!-- section -->
        <div style="display: none;" lass="col-lg-5">
            <!-- map-->
            <div id="map-canvas" class="mt-5 rounded"></div>
        </div>

        <!-- /Section -->
    </div>
    <!--/ page-wrapper -->

    <!-- ==== footer ==== -->
    @include('Plantilla.Footer')
    @yield('scripts')
