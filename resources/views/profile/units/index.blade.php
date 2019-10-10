<!DOCTYPE html>
<html>
<head>
	<title>Mis Units | Mostla</title>
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

	<h1>Mis Units</h1>
    <a href="/unit/create">Crear</a>
    <table style="width:80%">
        <tr>
            <th>Número serial</th>
            <th>Status</th>
            <th>Fecha de creación</th>
            <th>Edición</th>
            <th>Disponible</th>
        </tr>
        @foreach($unitsIndex as $unit)
        <tr>
            <td>{{$unit->serial_number}}</td>
            <td>{{$unit->status}}</td>
            <td>{{$unit->created_at}}</td>
            <td><a href="/unit/edit/{{ $unit->id }}">Editar</a></td>
            @if($unit->deleted_at != null)
              <td><a href="/unit/activate/{{ $unit->id }}">Activar</a></td>
            @else
              <td><a href="/unit/delete/{{ $unit->id }}">Eliminar</a></td>
            @endif
        </tr>
        @endforeach
    </table>

</body>
</html>