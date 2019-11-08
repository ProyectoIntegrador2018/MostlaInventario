@extends('layouts.app')

@section('content')
	<style>
		.clickable{
			cursor: copy;
		}
    .hideElement{
    		display: None;
    	};
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
		<button id="consultar">Consultar</button>
	</form>
    <table id="table-product">
        <tr>
            <th>Nombre</th>
            <th>Marca</th>
        </tr>
	        @foreach($products as $product)
	        <tr>
	            <td>{{$product->name}}</td>
	            <td>{{$product->description}}</td>
	        </tr>
	        @endforeach
    	</div>
    </table>
    <table id="table-filter" class="hideElement">
    </table>
@endsection

@push('scripts')
	<script type="text/javascript">
		// Initialize label carrito
		$("#carrito").text("("+sessionStorage.length+")")
		// Save to label
		$("#table-product").on("click", 'td', function(e) {
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