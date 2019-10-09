<!DOCTYPE html>
<html>
<head>
	<title>Mis Categorías | Mostla</title>
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

	<h1>Mis Categorías</h1>
    <a href="/category/create">Crear</a>
    <table style="width:80%">
        <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Fecha de creación</th>
            <th>Edición</th>
            <th>Disponible</th>
        </tr>
        <!-- {{-- @foreach($categoriesIndex as $category) --}}
        <tr>
            <td>{{--$category->id--}}</td>
            <td>{{--$category->name--}}</td>
            <td>{{--$category->created_at--}}</td>
            <td><a href="/category/edit/{{-- $category->id --}}">Editar</a></td>
            {{-- @if($category->deleted_at != null) --}}
              <td><a href="/category/activate/{{-- $category->id --}}">Activar</a></td>
            {{-- @else --}}
              <td><a href="/category/delete/{{-- $category->id --}}">Eliminar</a></td>
            {{-- @endif --}}
        </tr>
        {{-- @endforeach --}} -->
        <tr><td>1</td><td>Hola</td><td>123123</td><td>editar</td><td>accion</td></tr>
    </table>

</body>
</html>