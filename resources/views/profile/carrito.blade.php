@extends('layouts.app')

@section('content')
	<section>
		<h1>Carrito</h1>
		<a href="/catalogo">Volver</a>
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
			innerCarrito += `<div product_id='${product.id}' class='card card-product'><div class='card-title'>${product.name}<p><a href='#'>Eliminar</a></p></div><div class='card-body'><div> Inicio: <input id="start_date" type='date'> Fin: <input id="end_date" type='date'> </div> </div> </div>`
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
	function apiCallReserve(reservations){
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
				console.log(error);
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
			res.start_date = $(this).find('#start_date')[0].value;
			res.end_date = $(this).find('#end_date')[0].value;

			if (res.start_date == "" || res.end_date == "" || new Date(res.start_date) > new Date(res.end_date)) {
				alert("Fechas no válidas");
				return;
			}

			reservations.push(res);
		});

		if (reservations.length > 0)
			apiCallReserve(reservations);
	});
</script>
@endpush
