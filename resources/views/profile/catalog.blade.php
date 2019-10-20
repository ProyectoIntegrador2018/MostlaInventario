@extends('layouts.app')

@section('content')
	<form action="/roles" method="POST">
		@csrf
		<label for="search">Búsqueda</label>
		<input id="search" type="text" name="search">
		<label for="categories">Categorías</label>
		<select id="categories" name="categories">
			@foreach($categories as $category)
				<option value={{$category->id}}>{{$category->name}}</option>
			@endforeach			
		</select>
		<label for="technology">Tecnologías</label>
		<select id="technology" name="technology">
			<option value=0>None</option>		
		</select>
		<input type="submit" value="Guardar">
	</form>

	<table>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>
        </tr>
        @endforeach
    </table>
@endsection