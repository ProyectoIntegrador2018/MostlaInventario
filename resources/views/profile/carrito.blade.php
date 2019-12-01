@extends('layouts.app')

@section('content')
<section>
	<h1>Canasta</h1>
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
			<form class="item-form" action="/cart/update/{{$item->pivot->id}}" method="POST">
				@csrf
				<div class="row">
					<div class="col-2">
						<button disabled class="btn btn-light">Inicio</button>
					</div>
					<div class="col">
						<input id="start_date" value="{{$item->pivot->start_date}}" id="" type="date" name="start_date" class="form-control">
					</div>
					<div class="col">
						<input id="start_time" value="{{$item->pivot->start_time}}" type="time" name="start_time" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-2">
						<button disabled class="btn btn-light">Fin</button>
					</div>
					<div class="col">
						<input id="end_date" value="{{$item->pivot->end_date}}" type="date" name="end_date" class="form-control">
					</div>
					<div class="col">
						<input id="end_time" value="{{$item->pivot->end_time}}" type="time" name="end_time" class="form-control">
					</div>
				</div>
			</form>
			@if($item->pivot->status == App\Models\CartItem::AVAILABLE)
			<i title="Disponible" class="fas fa-check-circle fa-2x"></i>
			@elseif($item->pivot->status == App\Models\CartItem::UNAVAILABLE)
			<i title="No Disponible" class="fas fa-times-circle fa-2x"></i>
			@elseif($item->pivot->status == App\Models\CartItem::INVALID)
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
		<form action="/cart/submit" method="POST" class="form-group">
			@csrf
			<p>El horario de atención es de 8:00 AM a 7:00 PM de Lunes a Viernes.</p>
			<p>Las personas usuarias se comprometen a tratar bien los equipos que se llevan, ya que quedan bajo su custodia, y deben devolverlas en el mismo estado en el que se las llevaron y ser devueltas en el plazo señalado.</p>
			<input id="compromiso" type="checkbox" name="compromiso" required>
			<label for="compromiso">Acepto estos términos.</label>
			<br>
			<input type="submit" value="Reservar" class="btn btn-primary">
		</form>
	</div>
</section>
@endsection

@push('scripts')
<script type="text/javascript">
	$('.item-form').find('input').change(function () {
		let form = this.form
		let inputs = $(form).find('input');
		let all = true;
		for (var i = inputs.length - 1; i >= 0; i--) {
			if (!$(inputs[i]).val()) {
				all = false;
			}
		}
		if (true) {
			console.log('submitting');
			let data = {
				_token: $(form).find('[name="_token"]').val(),
				start_date: $(form).find('#start_date').val(),
				start_time: $(form).find('#start_time').val(),
				end_date: $(form).find('#end_date').val(),
				end_time: $(form).find('#end_time').val(),
			};
			console.log($(form).attr('action'));
			console.log(data);
			$.post($(form).attr('action'), data);
		}
	});
</script>
@endpush