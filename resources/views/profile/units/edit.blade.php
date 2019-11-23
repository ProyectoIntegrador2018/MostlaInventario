@extends('layouts.app')

@section('content')
<section>
	<h1>Editar Unit</h1>
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <a href="{{ url()->previous() }}">< Regresar</a>
	<div class="box">
    <form action="/unit/update/{{$unitEdit->id}}">
        Producto:<br>
        <select class="selectpicker form-control" disabled name="product_id">
            <option value="{{$unitEdit->product_id}}">{{$unitEdit->product->name}}</option>
        </select>
        <br>
        Número serial:<br>
        <input type="text" name="serial_number" value="{{$unitEdit->serial_number}}" /><br>
        Status:<br>
        <input type="text" name="status" value="{{$unitEdit->status}}" /><br>
        <br>
        <input class = "btn btn-primary" type="submit" value="Guardar">
    </form>
</div>
</section>
@endsection
