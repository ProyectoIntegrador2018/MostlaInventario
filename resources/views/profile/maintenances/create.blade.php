@extends('layouts.app')

@section('content')

<section>

	<h1>Agregar mantenimiento</h1>
	<a href="{{ url()->previous() }}">< Regresar</a>
	<br>
	<form class="inline-form" action="/maintenances/store" method="POST">
		@csrf
		Product:<br>
        <select disabled class="selectpicker form-control" name="product_id">
            <option value="{{$unitCreated->product->id}}" selected>{{$unitCreated->product->name}}</option>
        </select>
		Unit:<br>
        <select disabled class="selectpicker form-control" name="unit_id">
            <option value="{{$unitCreated->id}}" selected>{{$unitCreated->serial_number}}</option>
        </select>
        <br>
		<div>
			Comentario:<br>
			<textarea class="form-control" name="comment"></textarea>
			<br>
		</div>
		<button type="submit" class="btn btn-primary">Crear</button>
	</form>
	</section>
@endsection