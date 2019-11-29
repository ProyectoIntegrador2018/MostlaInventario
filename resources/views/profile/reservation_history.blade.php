@extends('layouts.app')

@section('content')
<section>
	<h1>Mis Reservaciones Pasadas</h1>
	<div class="table-container">
		<table>
			<tr>
				<th>Equipo</th>
				<th>Inició</th>
				<th>Terminó</th>
			</tr>

			@forelse($reservations as $reservation)
			<tr>
				<td>
                    <span class="subtle">{{$reservation->product->brand}}</span>
                    {{$reservation->product->name}}
                </td>
				<td>{{$reservation->start_date->format('d/M/Y - h:i A')}}</td>
				<td>{{$reservation->end_date->format('d/M/Y - h:i A')}}</td>
			</tr>
			@empty
			<td class="empty" colspan="6">No hay reservaciones para mostrar aquí.</td>
			@endforelse
		</table>
	</div>
	<a href="/profile">Regresar a Mis Reservaciones</a>
</section>

@endsection