@extends('layouts.app')

@section('content')
<section>
	<h1>Detalle de producto: <b>{{$product->name}}<b/></h1>

	<a href="/products"> < Regresar</a>
	<a class="float-right" href="/product/edit/{{ $product->id }}">Editar</a>
	<br>

	<div class="box">
		<div class="row">
			<div class="col">
				<h5>Modelo</h5>
			</div>
			<div class="col">
				<body>{{$product->name}}</body>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<h5>Marca</h5>
			</div>
			<div class="col">
				<body>{{$product->brand}}</body>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<h5>Descripcion del producto</h5>
			</div>
			<div class="col">
				<body>{{$product->description}}</body>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<h5>Categoria</h5>
			</div>
			<div class="col">
				<body>{{$product->category->name}}</body>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<h5>Tags</h5>
			</div>
			<div class="col">
			<ul>
				@foreach($product->tags as $tag)
					<li>{{ $tag->name }}</li>
				@endforeach
			</ul>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<h5>Numeros de serie</h5>
			</div>
			<div class="col">
				<ul>
				@foreach($product->units as $unit)
				<li>{{ $unit->serial_number }}</li>
				@endforeach
			</ul>
			</div>
		</div>

	</div>













</section>
@endsection
