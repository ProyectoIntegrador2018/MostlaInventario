@extends('layouts.app')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
@endpush

@section('content')
	<section>
		<h1>Mi Perfil</h1>
		<form action="/profile/campus" method="POST">
			@csrf
			<label for="campus">Mi campus: </label>
			<select  class="selectpicker form-control" id="campus" required name="campus_id" onchange="this.form.submit()">
				<option selected hidden disabled>Seleccione su campus</option>>
				@foreach($campus as $c)
					<option value={{$c->id}} {{$c->id === ($user_campus->id ?? null) ? "selected" : ""}}>{{$c->name}}</option>
				@endforeach
			</select>
		</form>
	</section>

	<section>
		<h1>Mis Reservaciones</h1>
		<table>
			<tr>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Cant.</th>
				<th>Inicia</th>
				<th>Termina</th>
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
		<a href="/profile/history">Ver mis reservaciones pasadas</a>
	</section>

@endsection

@push('scripts')
<script type="text/javascript">
	$('#campus').select2();
</script>
@endpush
