@extends('layouts.app')

@section('content')


<section>

	<h1>Agregar número de serie</h1>
	@if ($errors->any())
	<ul>
		@foreach($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>
	@endif
	<a href="/units">< Regresar</a>
	<br>
	<form class="inline-form" action="/unit/store">
		Producto:<br>

		<select class="selectpicker form-control" name="product_id">
			@foreach($products as $product)
			<option value="{{$product->id}}">{{$product->name}}</option>
			@endforeach
		</select>

		<br>
		<div>
			<br>
			Número serial:<br>
			<input type="textarea" class="form-control" name="serial_number" /><br>
			<span class="input-group-btn">
				Status:<br>
				<input type="textarea" class="form-control" name="status" /><br>
				<br>
				<input class="btn btn-primary" type="submit" value="Submit">
			</div>


		</form>
	</section>
	@endsection
