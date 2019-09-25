<!DOCTYPE html>
<html>
<head>
	<title>Editar Producto | Mostla</title>
</head>
<body>

	<h1>Editar Producto</h1>

    <h3>Nombre: {{$product->name}}</h3>

    <p>Descripción: {{$product->description}}</p>
    <p>Marca: {{$product->brand}}</p>
    <p>Categoría: {{$product->category_id}}</p>

    <a href="/products">Regresar</a>

</body>
</html>