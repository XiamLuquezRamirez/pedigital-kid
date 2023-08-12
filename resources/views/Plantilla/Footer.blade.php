@if (Session::get('ZonaJuegoAct') == 'NO')
<img src="{{asset('img/ornaments/whale.png')}}" class="floating-whale" alt="">
<!-- waves -->
<div class="waveHorizontals">
    <div id="waveHorizontal1" class="waveHorizontal"></div>
    <div id="waveHorizontal2" class="waveHorizontal"></div>
    <div id="waveHorizontal3" class="waveHorizontal"></div>
</div>
@endif

<footer class="bg-secondary text-light">
    <div class="container">

        <div class="row">
            <div class="credits col-sm-12">
                <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="#"> PEDIGITAL-KIDS</a> </p>
            </div>
        </div>
        <!--/row-->
    </div>
    <!--/ container -->
    <!-- Go To Top Link -->
    <div class="page-scroll hidden-sm hidden-xs">
        <a href="#top" class="back-to-top"><i class="fa fa-angle-up"></i></a>
    </div>
    <!--/page-scroll-->
</footer>
<!--/ footer-->
<!-- Bootstrap core & Jquery -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>
<!-- Prefix free -->
<script src="{{asset('js/prefixfree.min.js')}}"></script>
<!-- number counter script -->
<script src="{{asset('js/counter.js')}}"></script>
<!-- maps -->
<!--<script src="{{asset('js/map.js')}}"></script>-->
<!-- GreenSock -->
<script src="{{asset('vendor/layerslider/js/greensock.js')}}"></script>
<!-- LayerSlider script files -->
<script src="{{asset('vendor/layerslider/js/layerslider.transitions.js')}}"></script>
<script src="{{asset('vendor/layerslider/js/layerslider.kreaturamedia.jquery.js')}}"></script>
<script src="{{asset('vendor/layerslider/js/layerslider.load.js')}}"></script>
<script src="{{asset('js/extensions/sweetalert.min.js')}}" type="text/javascript"></script>

<script src="{{asset('js/extensions/sweet-alerts.js')}}" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" src="{{asset('js/codemirror.css')}}">
<link rel="stylesheet" type="text/css" src="{{asset('js/monokai.css')}}">
<script src="{{asset('js/jquery.steps.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.steps.min.js')}}" type="text/javascript"></script>

<script src="{{asset('js/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script src="{{asset('js/ckeditor/styles.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.zoom.js') }}" type="text/javascript"></script>






