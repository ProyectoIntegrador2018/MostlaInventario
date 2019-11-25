<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto&display=swap" rel="stylesheet">
    <!-- Font-Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/b15bbf55e4.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light shadow-lg">
            <div class="container">
                <a class="navbar-brand" href="/"><img src={{ asset('img/logo.png') }}  alt="Mostla Logo"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        {{-- Para guests --}}
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>

                        {{-- Para usuarios --}}
                        @else
                        {{-- Admins --}}
                        @if(auth()->user()->type_id > 1)


                        <li class="nav-item">
                            <a class="nav-link" href="/products">
                            <img class ="icon" src="/img/inventario_hover.png" alt="Inventario"></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">
                            <img class ="icon" src="/img/dashboard_hover.png" alt="Dashboard"></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/reports">
                            <img class ="icon" src="/img/report_hover.png" alt="Report">
                            </a>
                        </li>

                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="/catalogo">
                            <img class ="icon" src="/img/reservar_hover.png" alt="Catalogo"></a>
                        </li>

                        @if(auth()->user() && auth()->user()->type_id > 1)
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-cog fa-fw"></i> <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="/categories">
                                    Categorías
                                </a>
                                <a class="dropdown-item" href="/tags">
                                    Tags
                                </a>
                                <a class="dropdown-item" href="/maintenances">
                                    Mantenimientos
                                </a>
                                <a class="dropdown-item" href="/roles">
                                    Roles
                                </a>
                            </div>
                        </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="/profile">
                                    Perfil
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>

        @yield('site-content')
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
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

@stack('scripts')

@if(session('alert'))
@include('layouts.alert')
@endif
</body>
</html>
