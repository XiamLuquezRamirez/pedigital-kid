@extends('Plantilla.Principal')
@section('title', 'Presentación Módulos Transversales')
@section('Contenido')

    <input type="hidden" name="grado" id="grado" value="{{ $Gradoalumno }}" />

    <iframe id="myIframe" src="{{ asset('juegos/Index.html?grado=') }}{{$Gradoalumno}}" frameborder="0" scrolling="yes" height="678" width="100%" name="demo">

    </iframe>

@endsection
@section('scripts')
    <script>
        $("#Men_Tablero").removeClass("nav-item active");
        $("#Men_ZonaPlay").addClass("nav-item active");
    </script>
@endsection
