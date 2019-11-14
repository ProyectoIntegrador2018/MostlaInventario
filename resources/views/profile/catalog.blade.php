@extends('layouts.app')

@section('content')
<section>
	<h1>Catálogo de Productos</h1>

	<div>
	<a class="float-right" href="/carrito">Carrito</a>
</div>
<br>

	<form action="/catalogo" class="inline-form">
		@csrf
		<div class="row">
			<div class="col">
				<input id="search" class="form-control" type="text" name="search" placeholder="Buscar">
			</div>
			<div class="col">
				<select name="categories" multiple title="Categorías" class="selectpicker form-control" data-selected-text-format="count > 1">
					<option hidden disabled value="">Categorías</option>
					@foreach($categories as $category)
					<option value={{$category->id}}>{{$category->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="col">
				<select name="technology" multiple title="Tags" class="selectpicker form-control" data-selected-text-format="count > 1">
					<option hidden disabled value="">Tags</option>
						@foreach($tags as $tag)
						<option value={{$tag->id}}>{{$tag->name}}</option>
						@endforeach
				</select>
			</div>
			<div class="col">
				<button id="catalog-consultar" type="submit" class="btn btn-primary">Filtrar</button>
			</div>
		</div>
	</form>

	<div class= "container">
	<div class = "row">
	<div class= "col">
		<div class="card-deck classWithPad">
			<div class="card-body">
	    		<h5 class="card-title">Nombre del Producto</h5>
	    		<p class="card-text">Descripcion corta del producto</p>
				<h6 class="card-subtitle mb-2 text-muted">tags X </h6>
				<a href="#" class="btn-sm btn-primary float-right">agregar</a>
			</div>
		</div>
	</div>
	<div class= "col">
		<div class="card-deck classWithPad">
			<div class="card-body">
	    		<h5 class="card-title">Nombre del Producto</h5>
	    		<p class="card-text">Descripcion corta del producto</p>
				<h6 class="card-subtitle mb-2 text-muted">tags X </h6>
				<a href="#" class="btn-sm btn-primary float-right">agregar</a>
			</div>
		</div>
	</div>
	<div class= "col">
		<div class="card-deck classWithPad">
			<div class="card-body">
				<h5 class="card-title">Nombre del Producto</h5>
				<p class="card-text">Descripcion corta del producto</p>
				<h6 class="card-subtitle mb-2 text-muted">tags X </h6>
				<a href="#" class="btn-sm btn-primary float-right">agregar</a>
			</div>
		</div>
	</div>
	</div>
	</div>


</section>
@endsection


@push('scripts')
<script type="text/javascript">
	$("#consultar").on("click", function(event) {
		event.preventDefault();
		$.ajax({
			type: 'GET',
			url: '/catalogo/search',
			data: {
				name: $('#search').val(),
				category: $("#categories").val(),
				tag: $("#technology").val()
			},
			dataType : 'json',
			success: function(data) {
				data = data.getproducts
				var newHTML = "";
				$("#table-filter").html("<tr><th>Nombre</th><th>Descripción</th></tr>");
				for(var i=0; i<data.length; i++)
				{
					newHTML += `<tr><td>${data[i].name}</td><td>${
						data[i].description}</td></tr>`
					}
					$("#table-filter").append(newHTML);
					$("#table-filter").removeClass("hideElement");
					$("#table-product").addClass("hideElement");
				},
				error: function(error) {
					console.log(error);
				}
			});
	});
</script>
@endpush
