@extends('layouts.app')

@section('content')
<section>
	<h1>Catálogo de Productos</h1>
	<a href="/carrito">Carrito</a>

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

	<table id="table-product">
		<tr>
			<th>Nombre</th>
			<th>Marca</th>
		</tr>
		@forelse($products as $product)
		<tr>
			<td>{{$product->name}}</td>
			<td>{{$product->description}}</td>
		</tr>
		@empty
			<td class="empty" colspan="2">Actualmente no hay productos disponibles.</td>
		@endforelse
	</div>
</table>
<table id="table-filter" class="hideElement">
</table>
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
