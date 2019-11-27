@extends('layouts.app')

@section('content')
@component('layouts.frame', [
	'title' => 'Dashboard de Reservaciones',
	'options' => [
		['name'=>'Enviar recordatorios', 'link'=>'/reminders/send']
	],
	])

	<div class="inline-form">
		<div class="row">
			<div class="col">
				<input type="text" id="search" class="form-control" placeholder="Buscar...">
			</div>
			<div class="col">
				<form>
					<select class="selectpicker" name="status" title="Estado" onchange="this.form.submit()">
						<option value="0">Todos</option>
						@foreach($statuses as $value => $status)
						<option value="{{ $value }}" {{ $value == ($filters['status'] ?? '') ? 'selected' : '' }}>{{ $status }}</option>
						@endforeach
					</select>
				</form>
			</div>
		</div>
	</div>

	@forelse($reservations as $reservation)
	<div class="long-card filterable">
		@switch($reservation->indicator)
			@case('waiting')
				<i title="Esperando inicio" class="far fa-circle fa-2x"></i>
			@break
	
			@case('ready')
				<i title="Lista para recoger" class="fas fa-bullseye fa-2x"></i>
			@break
	
			@case('current')
				<i title="En Progreso" class="far fa-check-circle fa-2x"></i>
			@break
	
			@case('late')
				<i title="Entrega tardía" class="fas fa-exclamation-circle fa-2x"></i>
			@break
	
			@case('done')
				<i title="Terminada" class="fas fa-check-circle fa-2x"></i>
			@break
	
			@case('cancelled')
				<i title="Cancelada" class="fas fa-circle fa-2x"></i>
			@break
		@endswitch
		<div>
			<h5>{{ $reservation->user->name }}</h5>
			<div>
				<span class="subtle">{{ $reservation->product->brand }}</span>
				{{ $reservation->product->name }}
			</div>
		</div>
		<div>
			<div>
				<span class="subtle">Inicia</span>
				{{ $reservation->start_date->format('d/M/Y - h:i A') }}
			</div>
			<div>
				<span class="subtle">Termina</span>
				{{ $reservation->end_date->format('d/M/Y - h:i A') }}
			</div>
		</div>
		<div>
			<form action="/reservations/{{ $reservation->id }}/status" method="POST">
				@csrf
				<select class="selectpicker" onchange="this.form.submit()" name="status">
					@foreach($statuses as $value => $status)
					<option value="{{ $value }}" {{ $value == $reservation->status ? 'selected' : '' }}>
						{{ $status }}
					</option>
					@endforeach
				</select>
			</form>
			@if($reservation->status == 'in_progress')
				<form action="/reservations/{{ $reservation->id }}/loan" method="POST">
					@csrf
					<select class="selectpicker" title="Unidad" onchange="this.form.submit()" name="unit_id">
						@forelse($reservation->product->units as $unit)
							<option value="{{ $unit->id }}" {{ $unit->id == ($reservation->loan->unit_id ?? null) ? 'selected' : '' }} {{ $unit->loan ? 'disabled' : '' }}>
								{{ $unit->serial_number }}
							</option>
						@empty
							<option value="-1" disabled>No hay unidades disponibles</option>
						@endforelse
					</select>
				</form>
			@endif
		</div>
	</div>
	@empty
	<div class="long-card empty">
		<div>No hay reservaciones por el momento.</div>
	</div>
	@endforelse
	@endcomponent
	@endsection

	@push('scripts')
	<script type="text/javascript">
        // Filter list of existing products based on user's input
        $('#search').on('change paste keyup', function(event){
        	let newValue = $('#search').val().toLowerCase();
        	$('.filterable').each(function(index, item){
        		let text = $(item).text().toLowerCase();
        		if (text.indexOf(newValue) >= 0) {
        			$(item).show();
        		} else {
        			$(item).hide();
        		}
        	});
        });

        $(".clickable_t").click(function () {
        	window.location = $(this).data('href');
        });
    </script>
    @endpush