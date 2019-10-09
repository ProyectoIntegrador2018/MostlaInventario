<!DOCTYPE html>
<html>
<head>
	<title>Editar Categoría | Mostla</title>
</head>
<body>

	<h1>Editar Categoría</h1>
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <a href="/categories">Regresar</a>
    <br><br>
    <form action="/category/update/{{$categoryEdit->id}}">
        Nombre:<br>
        <input type="text" name="name" value="{{$categoryEdit->name}}" /><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>