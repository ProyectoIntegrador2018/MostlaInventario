@extends('layouts.app')

@section('content')
	<form action="/roles" method="POST">
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
            <th>Descripción</th>
        </tr>
        <div>
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
    <style>
    	.hideElement{
    		display: None;
    	};
	</style>
@endsection


@push('scripts')
	<script>
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
