@extends('layouts.app')

@section('content')
<section>
    <h1>Crear Tag</h1>
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <a href="/tags">< Regresar</a>
    <br>
    <form class="box" action="/tag/store">
        Nombre:<br>
        <input class="form-control" type="text" name="name" value="" /><br>
        <input class="btn  btn-primary" type="submit" value="Guardar">
    </form>
</section>
@endsection