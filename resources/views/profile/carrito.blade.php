@extends('layouts.app')

@section('content')
	<section>
		<h1>Carrito</h1>
		<a href="/catalogo"> < Regresar</a>
		<div id="carrito"></div>
		<div>
			<button id="reserve" class="btn btn-primary">Consultar</button>
		</div>
	</section>
@endsection

@push('scripts')
<script type="text/javascript">
	function showCarrito(){
		var products = localStorage.getItem('products') != null ? JSON.parse(localStorage.getItem('products')) : [];
		var innerCarrito = ""
		for(product of products) {
			innerCarrito += `<div product_id='${product.id}' class='card card-product'><div class='card-title'>${product.name}<p><a href='#'>Eliminar</a></p></div><div class='card-body'><div> Día: <input id="reservation_day" type='date'> Inicio: <input id="start_hour" type="time"> Fin: <input id="end_hour" type="time"> </div> </div> </div>`
		}
		$("#carrito").append(innerCarrito)
	}
	showCarrito()
	$("#carrito").on("click", 'a', function(e) {
		e.preventDefault()
		let productId = $(e.currentTarget).closest('[product_id]').attr('product_id')
		var products = localStorage.getItem('products') != null ? JSON.parse(localStorage.getItem('products')) : [];
		products = products.filter(function(p) {
			return p.id !== parseInt(productId)
		});
		localStorage.setItem('products', JSON.stringify(products));
		$("#carrito").html("")
		showCarrito()
	});
	function checkMinMax(start_hour, end_hour) {
		return start_hour < "08:00" || end_hour < "08:00" || start_hour > "19:00" || end_hour > "19:00";
	}

	function oldDay(day) {
		return new Date().toJSON().slice(0,10).replace(/-/g,'-') > day;
	}

	function apiCallReserve(reservations) {
		$.ajax({
			type: 'POST',
			url: '/reservation',
			data: {
				reservation: reservations,
				_token: $('meta[name="csrf-token"]').attr('content')
			},
			dataType : 'json',
			success: function(data) {
				alert("Reservacion con éxito");
				localStorage.clear();
			},
			error: function(error) {
				alert(error.responseJSON[1]);
			}
		});
	}
</script>
<script type="text/javascript">
	$("#reserve").on("click", function() {
		var reservations = [];
		$('.card-product').each(function(){
			console.log($(this))
			var res = {};
			res.product_id = $(this).attr('product_id');
			//Dates
			let res_day = $(this).find('#reservation_day')[0].value;
			var start_hour = $(this).find('#start_hour')[0].value;
			var end_hour = $(this).find('#end_hour')[0].value;

			if (res_day == "" || oldDay(res_day) || start_hour == "" || end_hour == "" || start_hour > end_hour || checkMinMax(start_hour, end_hour)) {
				alert("Fechas no válidas");
				return;
			}

			res.start_date = res_day + ' ' + start_hour + ':00'
			res.end_date = res_day + ' ' + end_hour + ':00'

			reservations.push(res);
		});

		if (reservations.length > 0)
			apiCallReserve(reservations);
	});
</script>
@endpush
