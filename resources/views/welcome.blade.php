@extends('layouts.app')

@section('content')

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
        
@endsection
