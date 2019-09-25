<!DOCTYPE html>
<html>
<head>
	<title>Mis Reservaciones | Mostla</title>
</head>
<body>

	<h1>Mis Reservaciones Pasadas</h1>

	<ul>
		@foreach($reservations as $reservation)
		<li>
			@foreach($reservation->details as $item)
			<ul>
				{{ $item->product->brand }} <strong>{{ $item->product->name }}</strong>
			</ul>
			@endforeach
		</li>
		<hr>
		@endforeach
	</ul>

	<a href="/my_reservations">Regresar a Mis Reservaciones</a>

</body>
</html>