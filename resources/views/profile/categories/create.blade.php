@extends('layouts.app')

@section('content')
<section>

	<h1>Crear Categoría</h1>
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <a href="/categories">< Regresar</a>
    <br>
    <form class="box" action="/category/store">
        Nombre:<br>
        <input class="form-control" type="text" name="name" value="" /><br>
        <input class="btn  btn-primary" type="submit" value="Guardar">
    </form>
@endsection
