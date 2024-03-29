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
			<select  class="selectpicker form-control" title="Seleccione su campus" id="campus" required name="campus_id" onchange="this.form.submit()">
				@foreach($campus as $c)
					<option value={{$c->id}} {{$c->id === ($user_campus->id ?? null) ? "selected" : ""}}>{{$c->name}}</option>
				@endforeach
			</select>
		</form>
	</section>

<section>
	<h1>Mis Reservaciones</h1>
	<div class="table-container">
		<table>
			<tr>
				<th>Equipo</th>
				<th>Inicia</th>
				<th>Termina</th>
				<th>Cancelar</th>
			</tr>

			@forelse($reservations as $reservation)
			<tr>
				<td>
                    <span class="subtle">{{$reservation->product->brand}}</span>
                    {{$reservation->product->name}}
                </td>
				<td>{{$reservation->start_date->format('d/M/Y - h:i A')}}</td>
				<td>{{$reservation->end_date->format('d/M/Y - h:i A')}}</td>
				<td>
					@if($reservation->status == 'pending')
					<a href="/reservations/{{ $reservation->id }}/cancel">x</a>
					@endif
				</td>
			</tr>
			@empty
			<td class="empty" colspan="6">No hay reservaciones para mostrar aquí.</td>
			@endforelse
		</table>
	</div>
	<a href="/profile/history">Ver mis reservaciones pasadas</a>
</section>

@endsection

@push('scripts')
<script type="text/javascript">
	$('#campus').select2();
</script>
@endpush
