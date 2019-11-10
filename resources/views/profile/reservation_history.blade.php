@extends('layouts.app')

@section('content')
	<section>
		<h1>Mis Reservaciones Pasadas</h1>
		<table>
			<tr>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Cant.</th>
				<th>Inició</th>
				<th>Terminó</th>
				<th>Cancelar</th>
			</tr>

			@forelse($reservations as $reservation)
			<tr>
				<td>{{$reservation->product->brand}}</td>
				<td>{{$reservation->product->name}}</td>
				<td>{{$reservation->quantity}}</td>
				<td>{{$reservation->start_date->format('d/M/Y - h:i')}}</td>
				<td>{{$reservation->end_date->format('d/M/Y - h:i')}}</td>
				<td>
					@if($reservation->can_cancel)
					<a href="/reservations/cancel/{{ $reservation->id }}">x</a>
					@endif
				</td>
			</tr>
			@empty
				<td class="empty" colspan="6">No hay reservaciones para mostrar aquí.</td>
			@endforelse
		</table>
		<a href="/profile">Regresar a Mis Reservaciones</a>
	</section>

@endsection