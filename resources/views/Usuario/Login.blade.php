@extends('Plantilla.Principal')
@section('title','Inicio')
@section('Contenido')
<div class="container">
    <section id="intro-cards" id="ListAsig" class="row pattern2 pt-lg-0">
        <div class="row">
            <!-- image -->
            <div class="col-lg-4">
               <a href="{{url('/Contenido/GradosxEstud/1')}}" title="Grado Primero">
               <img src="img/primero.png" class="blob img-fluid" alt="">
               </a>
            </div>
            <!-- image -->
            <div class="col-lg-4">
               <a href="{{url('/Contenido/GradosxEstud/2')}}" title="Grado Segundo">
               <img src="img/segundo.png" class="blob2 img-fluid" alt="">
               </a>
            </div>
            <!-- image -->
            <div class="col-lg-4">
               <a href="{{url('/Contenido/GradosxEstud/3')}}" title="Grado Tercero">
               <img src="img/tercero.png" class="blob img-fluid" alt="">
               </a>
            </div>
            <!-- image -->
            <div class="col-lg-4">
               <a href="{{url('/Contenido/GradosxEstud/4')}}" title="Grado Cuarto">
               <img src="img/cuarto.png" class="blob2 img-fluid" alt="">
               </a>
            </div>
            <div class="col-lg-4">
                <a href="{{url('/Contenido/GradosxEstud/5')}}" title="Grado Quinto">
                <img src="img/quinto.png" class="blob2 img-fluid" alt="">
                </a>
             </div>
         </div>
    </section>


</div>

@endsection