<!DOCTYPE html>
<html>
<head>
	<title>Editar Unit | Mostla</title>
</head>
<body>

	<h1>Editar Unit</h1>
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <a href="/units">Regresar</a>
    <br><br>
    <form action="/unit/update/{{$unitEdit->id}}">
        Producto:<br>
        <select disabled name="product_id">
            <option value="{{$unitEdit->product_id}}">{{$unitEdit->product->name}}</option> 
        </select>
        <br>
        Número serial:<br>
        <input type="text" name="serial_number" value="{{$unitEdit->serial_number}}" /><br>
        Status:<br>
        <input type="text" name="status" value="{{$unitEdit->status}}" /><br>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>