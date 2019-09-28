<!DOCTYPE html>
<html>
<head>
	<title>Crear Producto | Mostla</title>
</head>
<body>

	<h1>Crear Producto</h1>
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <a href="/products">Regresar</a>
    <br><br>
    <form action="/product/store">
        Nombre:<br>
        <input type="text" name="name" value="" /><br>
        Marca:<br>
        <input type="text" name="brand" value="" /><br>
        Descripción:<br>
        <input type="textarea" name="description" value="" /><br>
        Categoria:<br>
        <input type="text" name="category_id" value="" /><br>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>