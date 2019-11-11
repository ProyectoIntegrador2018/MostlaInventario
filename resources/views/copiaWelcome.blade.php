<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Mostla | Reservaciones</title>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Project CSS -->
        <link rel="stylesheet" type="text/css" href={{ asset('css/app.css') }} />

    </head>

    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class ="navbar-header"

                <!-- Button for our movil version -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <!-- 3 lines standar for the movil version of the toggle -->
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- link to the landing page -->
                <!-- update href & broken src -->
                <a class="navbar-brand" href="#"><img src={{ asset('img/logo.png') }}  alt="Mostla Logo"></a>
            </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- this is the page in which we are right now -->
                        <li class="active"><a href="#"> Mostla</a></li>
                        <li><a href="#">Reservaciones</a></li>
                        <li><a href="#">Nueva Reservacion</a></li>
                        <li><a href="#">Mantenimiento</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1" > </li>
                <li data-target="#myCarousel" data-slide-to="2" > </li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class= "item active">
                    <img class="img-responsive" src={{ asset('img/mostla-foto-1.png') }} >
                    <div class="carousel-caption">
                    </div>
                </div> <!--- end active--->
                <div class="item">
                    <img class="img-responsive" src="img/mostla-foto-2.png">
                </div>
                <div class="item">
                    <img class="img-responsive" src="img/mostla-foto-4.png">
                </div>
            </div>
        </div> <!--- end slider/carousel --->

        <div class="container">
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

        <div class= "container">
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
        <footer class="container-fluid text-center">
            <div class="row">
                <div class = "col-sm-4">
                    <h3>Escribenos</h3>
                    <br>
                    <h4>mostla@servicios.itesm.mx</h4>
                </div>
                <div class = "col-sm-4">
                    <h3>Redes Sociales</h3>
                    <br>
                    <a href="https://www.facebook.com/mostlatec/" class="fa fa-facebook"></a>
                    <a href="https://twitter.com/mostlatec?lang=en" class="fa fa-twitter"></a>
                    <a href="https://www.youtube.com/channel/UC-LVFDiU8L5ymT5CyL7rRAg" class="fa fa-youtube"></a>
                </div>
                <div class = "col-sm-4">
                    <h3>Encuentranos</h3>
                    <br>
                    <h4>Tecnológico de Monterrey Campus MTY</h4>
                </div>
            </div>
        </footer>



    </body>
</html>
