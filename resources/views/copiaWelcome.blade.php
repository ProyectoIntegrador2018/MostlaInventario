@extends('layouts.site')

@section('site-content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img class="img-responsive" src={{ asset('img/mostla-foto-1.png') }} >
    </div>
    <div class="carousel-item">
      <img class="img-responsive" src="img/mostla-foto-2.png">
    </div>
    <div class="carousel-item">
      <img class="img-responsive" src="img/mostla-foto-4.png">
    </div>
  </div>
</div>

<div class="section-container container">
    <h2 class="text-center"> Tendencias </h2>
    <div class="row justify-content-center">
        <div class="col-sm-2 col-md-2"> </div>
        <div class="col-sm-1 col-md-1">
            <img src={{ asset('img/icons/ai-icon.png') }} id="icon">
        </div>
        <div class="col-sm-1 col-md-1">
            <img src={{ asset('img/icons/asistentes-icon.png') }} id="icon">
        </div>
        <div class="col-sm-1 col-md-1">
            <img src={{ asset('img/icons/blockchain-icon.png') }} id="icon">
        </div>
        <div class="col-sm-1 col-md-1">
            <img src={{ asset('img/icons/drones-icon.png') }} id="icon">
        </div>
        <div class="col-sm-1 col-md-1">
            <img src={{ asset('img/icons/impresion-icon.png') }} id="icon">
        </div>
        <div class="col-sm-1 col-md-1">
            <img src={{ asset('img/icons/iot-icon.png') }} id="icon">
        </div>
        <div class="col-sm-1 col-md-1">
            <img src={{ asset('img/icons/telepresencia-icon.png') }} id="icon">
        </div>
        <div class="col-sm-1 col-md-1">
            <img src={{ asset('img/icons/vr-icon.png') }} id="icon">
        </div>
        <div class="col-sm-2 col-md-2"></div>
    </div>
</div>

<div class= "section-container container">
    <div class = "row">
        <div class="col-md-6">
            <h4> Laboratorios Mostla </h4>
            <p> El futuro de la educación está en incorporar las nuevas tecnologías en el modelo educativo, y en el Campus Monterrey ya hay un lugar donde tanto profesores y alumnos pueden experimentar con éstas y conocerlas a fondo.</p>
            <p> Mostla se enfoca en promover y facilitar la experimentación e innovación entre maestros, estudiantes, colaboradores y todos aquellos interesados en las tecnologías educativas, ofreciéndoles la oportunidad de experimentar con tendencias de tecnología emergente conectando diferentes áreas de especialización y mostrando qué se está haciendo en innovación educativa. </p>
        </div>
        <div class="col-md-6">
            <img src="img/mostla-foto-5.png" class="img-responsive">
        </div>
    </div>
</div>
@endsection