<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Mostla | Reservaciones</title>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                crossorigin="anonymous"></script>
        <!-- Bootstrap CSS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Font-Awesome -->
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
                        <li class="active"><a href="#"> Catalogo</a></li>
                        <li class="nav-list"><a href="#">Mis Reservaciones</a></li>
                        <li ><a href="#">Carrito</a></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <h2 class="text-left"> Catalogo </h2>
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <!-- Search form -->
                    <br>
                    <input class="form-control active-cyan-4 mb-4 classWithPad" type="text" placeholder="Search" aria-label="Search">
                </div>
                <div class="col-sm-4">
                    <div class="dropdown classWithPad">
                        <button class="btn btn-primary dropdown-toggle"  type="button" data-toggle="dropdown">Categorias
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Asistentes</a></li>
                            <li><a class="dropdown-item" href="#">Artificial Inteligence</a></li>
                            <li><a class="dropdown-item" href="#">Blockchain</a></li>
                            <li><a class="dropdown-item" href="#">Drones</a></li>
                            <li><a class="dropdown-item" href="#">Impresion 3D</a></li>
                            <li><a class="dropdown-item" href="#">Internet of Things</a></li>
                            <li><a class="dropdown-item" href="#">Telepresencia</a></li>
                            <li><a class="dropdown-item" href="#">Realidad Virtual</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="dropdown classWithPad">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Categorias
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Asistentes</a></li>
                            <li><a class="dropdown-item" href="#">Artificial Inteligence</a></li>
                            <li><a class="dropdown-item" href="#">Blockchain</a></li>
                            <li><a class="dropdown-item" href="#">Drones</a></li>
                            <li><a class="dropdown-item" href="#">Impresion 3D</a></li>
                            <li><a class="dropdown-item" href="#">Internet of Things</a></li>
                            <li><a class="dropdown-item" href="#">Telepresencia</a></li>
                            <li><a class="dropdown-item" href="#">Realidad Virtual</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class= "container">
            <div class = "row">
                <div class="col-md-4">
                    <div class="card-deck classWithPad">
                        <h2 class="display-5">Nombre del Producto</h2>
                        <p class="lead">Descripcion corta</p>
                        <h2 class="display-5">Caracteristicas</h2>
                        <p class="tab">feature 1</p>
                        <p class="tab">feature 2</p>
                        <p class="tab">feature 3</p>
                        <div class = "text-right">
                            <a href="#" id="roundEdge" class="btn btn-primary">agregar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-deck classWithPad">
                        <h2 class="display-5">Nombre del Producto</h2>
                        <p class="lead">Descripcion corta</p>
                        <h2 class="display-5">Caracteristicas</h2>
                        <p class="tab">feature 1</p>
                        <p class="tab">feature 2</p>
                        <p class="tab">feature 3</p>
                        <div class = "text-right">
                            <a href="#" id="roundEdge" class="btn btn-primary">agregar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class=" card-deck classWithPad">
                        <h2 class="display-5">Nombre del Producto</h2>
                        <p class="lead">Descripcion corta</p>
                        <h2 class="display-5">Caracteristicas</h2>
                        <p class="tab">feature 1</p>
                        <p class="tab">feature 2</p>
                        <p class="tab">feature 3</p>
                        <div class = "text-right">
                            <a href="#"  id="roundEdge" class="btn btn-primary">agregar</a>
                        </div>
                    </div>
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
