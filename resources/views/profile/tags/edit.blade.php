@extends('layouts.app')

@section('content')
<section>
    <h1>Editar Tag</h1>
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <a href="/tags">< Regresar</a>
    <br>
    <form class="box" action="/tag/update/{{$tagEdit->id}}">
        Nombre:<br>
        <input class="form-control" type="text" name="name" value="{{$tagEdit->name}}" /><br>
        <input class="btn  btn-primary" type="submit" value="Guardar">
    </form>
</section>
@endsection