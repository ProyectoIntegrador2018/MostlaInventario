<!DOCTYPE html>
<html>
<head>
	<title>Crear Categoría | Mostla</title>
</head>
<body>

	<h1>Crear Categoría</h1>
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <a href="/categories">Regresar</a>
    <br><br>
    <form action="/category/store">
        Nombre:<br>
        <input type="text" name="name" value="" /><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>