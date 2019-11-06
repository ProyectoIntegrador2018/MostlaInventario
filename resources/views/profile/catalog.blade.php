@extends('layouts.app')

@section('content')
	<style>
		.clickable{
			cursor: copy;
		}
	</style>
	<div>
		<p>Carrito <span id="carrito"></span></p>
	</div>
	<form action="/#" method="POST">
		@csrf
		<label for="search">Búsqueda</label>
		<input id="search" type="text" name="search">
		<label for="categories">Categorías</label>
		<select id="categories" name="categories" multiple>
			@foreach($categories as $category)
				<option value={{$category->id}}>{{$category->name}}</option>
			@endforeach			
		</select>
		<label for="technology">Tecnologías</label>
		<select id="technology" name="technology" multiple>
			@foreach($tags as $tag)
				<option value={{$tag->id}}>{{$tag->name}}</option>
			@endforeach		
		</select>
		<input type="submit" value="Consultar">
	</form>

	<table id="catalogo">
        <tr>
            <th>Nombre</th>
            <th>Marca</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{{$product->name}}</td>
            <td>{{$product->brand}}</td>
            <td>{{$product->description}}</td>
            <td id={{$product->id}} class="clickable">Agregar</td>
        </tr>
        @endforeach
    </table>
@endsection

@push('scripts')
	<script type="text/javascript">
		// Initialize label carrito
		$("#carrito").text("("+sessionStorage.length+")")
		// Save to label
		$("#catalogo").on("click", 'td', function(e) {
			e.preventDefault()
			row = $(e.currentTarget)
			if(row.hasClass("clickable")){
				var productId = row.attr('id')
				var item = row.closest("tr")
				var product = {
					'p_id' : productId,
			        'p_name' : item.find('td:eq(0)').text(),
			        'p_brand' : item.find('td:eq(1)').text()
			    }
			    sessionStorage.setItem(productId, JSON.stringify(product));
			    // Update label carrito
			    $("#carrito").text("("+sessionStorage.length+")")
			}
		});
	</script>
@endpush
