<!DOCTYPE html>
<html>
<head>
	<title>Mis Productos | Mostla</title>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

	<h1>Mis Productos</h1>
    <a href="/product/create">Crear</a>
    <table style="width:80%">
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Marca</th>
            <th>Categoría</th>
            <th>Fecha de creación</th>
            <th>Edición</th>
            <th>Disponible</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->brand}}</td>
            <td>{{$product->category_id}}</td>
            <td>{{$product->created_at}}</td>
            <td><a href="/product/edit/{{ $product->id }}">Editar</a></td>
            @if($product->deleted_at != null)
              <td><a href="/product/activate/{{ $product->id }}">Activar</a></td>
            @else
              <td><a href="/product/delete/{{ $product->id }}">Eliminar</a></td>
            @endif
        </tr>
        @endforeach
    </table>

</body>
</html>