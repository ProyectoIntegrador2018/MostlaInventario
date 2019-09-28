<!DOCTYPE html>
<html>
<head>
	<title>Editar Producto | Mostla</title>
</head>
<body>

	<h1>Editar Producto</h1>
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <a href="/products">Regresar</a>
    <br><br>
    <form action="/product/update/{{$productEdit->id}}">
        Nombre:<br>
        <input type="text" name="name" value="{{$productEdit->name}}" /><br>
        Marca:<br>
        <input type="text" name="brand" value="{{$productEdit->brand}}" /><br>
        Descripción:<br>
        <input type="textarea" name="description" value="{{$productEdit->description}}" /><br>
        Categoria:<br>
        <input type="text" name="category_id" value="{{$productEdit->category_id}}" /><br>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>