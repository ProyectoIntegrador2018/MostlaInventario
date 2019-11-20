@extends('layouts.app')

@section('content')
<section>
    <div class="title-bar">
		<h1>Catálogo de Productos</h1>
		<a href="/canasta">Canasta <span id="product-count"></span></a>
    </div>

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
			@forelse($products as $product)
				<div class= "col">
					<div class="card-deck classWithPad">
						<div class="card-body">
							<h5 class="card-title">
								<span class="subtle">{{ $product->brand }}</span>
								{{ $product->name }}
							</h5>
							<p class="card-text">
								<span class="subtle">{{ $product->units_count }} disponibles</span>
							</p>
							<p class="card-text">{{ $product->description }}</p>
							<h6 class="card-subtitle mb-2 text-muted">{{ $product->tags()->pluck('name')->join(', ') }}</h6>
							<button class="add-to-cart btn-sm btn-primary float-right" product_id="{{$product->id}}">agregar</button>
						</div>
					</div>
				</div>
				@if(!$loop->iteration % 3 && !$loop->last)
					</div>
					<div class="row">
				@endif
			@empty
				<div class="table-container">
					<table>
						<td class="empty">No hay productos disponibles por el momento.</tr>
					</table>
				</div>
			@endforelse
		</div>
	</div>

</section>

<!-- Modal -->
<div class="modal fade" id="detalles" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Detalles</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

			</div>
		</div>
	</div>
</div>

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

<script type="text/javascript">
	$(document).ready(function(){
		//Count of cart items
		var products = localStorage.getItem('products') != null ? JSON.parse(localStorage.getItem('products')) : [];
		$("#product-count").html("(" + products.length + ")");

		$(".add-to-cart").on("click", function() {
			var products = localStorage.getItem('products') != null ? JSON.parse(localStorage.getItem('products')) : [];
			var product_id = $(this).attr('product_id');
			for (id of products) {
				if (id == product_id) {
					alert('El producto ya está en el carrito');
					return;
				}
			}
			products.push(product_id);
			localStorage.setItem('products', JSON.stringify(products));
			$("#product-count").html("(" + products.length + ")");
			alert("Producto agregado correctamente");
		});
	})
</script>
@endpush
