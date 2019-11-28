@extends('layouts.app')

@section('content')
	<section>
		<h1>Carrito</h1>
		<a href="/catalogo"> < Regresar</a>
		<div id="carrito">
			@forelse($cart as $item)
			<div class="long-card filterable">
				<div>
					<h5>
						<span class="subtle">{{ $item->brand }}</span>
						{{ $item->name }}
					</h5>
				</div>
				<div>
					<div class="row" class="form-row">
						<div class="col-2">
							<button disabled class="btn btn-light">Inicio</button>
							<button disabled class="btn btn-light">Fin</button>
						</div>
						<div class="col">
							<form action="/cart/update/{{$item->pivot->id}}" method="POST">
								@csrf
								<input value="{{$item->pivot->start_date}}" onchange="this.form.submit()" id="" type="date" name="start_date" class="form-control">
							</form>
							<form action="/cart/update/{{$item->pivot->id}}" method="POST">
								@csrf
								<input value="{{$item->pivot->end_date}}" onchange="this.form.submit()" type="date" name="end_date" class="form-control">
							</form>
						</div>
						<div class="col">
							<form action="/cart/update/{{$item->pivot->id}}" method="POST">
								@csrf
								<input value="{{$item->pivot->start_time}}" onchange="this.form.submit()" type="time" name="start_time" class="form-control">
							</form>
							<form action="/cart/update/{{$item->pivot->id}}" method="POST">
								@csrf
								<input value="{{$item->pivot->end_time}}" onchange="this.form.submit()" type="time" name="end_time" class="form-control">
							</form>
						</div>
					</div>
				</div>
				<div hidden>{{ $available = $item->pivot->isAvailable() }}</div>
				@if($available === true)
					<i title="Disponible" class="fas fa-check-circle fa-2x"></i>
				@elseif($available === false)
					<i title="No Disponible" class="fas fa-times-circle fa-2x"></i>
				@elseif($available === 'invalid')
					<i title="Fechas Inválidas" class="fas fa-exclamation-circle fa-2x"></i>
				@endif
				<div>
					<a href="/cart/remove/{{ $item->id }}"><i class="fas fa-trash-alt fa-lg"></i></a>
				</div>
			</div>
			@empty
			<div class="long-card empty">
				<div>No hay reservaciones por el momento.</div>
			</div>
			@endforelse
		</div>
		<div>
			<form action="/cart/submit" method="POST">
				@csrf
				<input type="submit" value="Reservar" class="btn btn-primary">
			</form>
		</div>
	</section>
@endsection
