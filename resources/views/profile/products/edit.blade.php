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
    <form action="/product/update/{{$product->id}}">
        Nombre:<br>
        <input type="text" name="name" value="{{$product->name}}" /><br>
        Marca:<br>
        <input type="text" name="brand" value="{{$product->brand}}" /><br>
        Descripción:<br>
        <input type="textarea" name="description" value="{{$product->description}}" /><br>
        Categoria:<br>
        <input type="text" name="category_id" value="{{$product->category_id}}" /><br>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>