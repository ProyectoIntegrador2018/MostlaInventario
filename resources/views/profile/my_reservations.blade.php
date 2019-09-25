<!DOCTYPE html>
<html>
<head>
	<title>Mis Reservaciones | Mostla</title>
</head>
<body>

	<h1>Mis Reservaciones</h1>

	<ul>
		@foreach($reservations as $reservation)
		<li>
			@if($reservation->isPending())
			<a href="/reservations/cancel/{{ $reservation->id }}">Cancel</a>
			@endif
			@foreach($reservation->details as $item)
			<ul>
				{{ $item->product->brand }} <strong>{{ $item->product->name }}</strong>
			</ul>
			@endforeach
		</li>
		<hr>
		@endforeach
	</ul>

	<a href="/my_reservations/history">Ver mis reservaciones pasadas</a>

</body>
</html>