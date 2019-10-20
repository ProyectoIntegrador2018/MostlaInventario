<!DOCTYPE html>
<html>
<head>
	<title>Mis Reservaciones | Mostla</title>
</head>
<body>

	<h1>Mi Campus</h1>
	<form action="/profile/campus" method="POST">
		@csrf
		<select name="campus_id" onchange="this.form.submit()">
			<option selected required hidden>Seleccione su campus</option>>
			@foreach($campus as $c)
				<option value={{$c->id}} {{$c->id === ($user_campus->id ?? null) ? "selected" : ""}}>{{$c->name}}</option>
			@endforeach
		</select>
	</form>

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