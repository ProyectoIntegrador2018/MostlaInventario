@extends('layouts.app')

@section('content')
	<section>
		<h1>Carrito</h1>
		<a href="/catalogo">Volver</a>
		<div>
			<button id="consultar" class="btn btn-primary">Consultar</button>
		</div>
	</section>
@endsection

@push('scripts')
	<script type="text/javascript">
		function showCarrito(){
			var products = localStorage.getItem('products') != null ? JSON.parse(localStorage.getItem('products')) : [];
			var innerCarrito = ""
			for(product of products) {
			  innerCarrito += `<div product_id='${product.id}' class='card'><div class='card-title'>${product.name}<p><a href='#'>Eliminar</a></p></div><div class='card-body'><div> Inicio: <input type='date'> Fin: <input type='date'> </div> </div> </div>`
			}
			$("#carrito").append(innerCarrito)	
		}
		showCarrito()
		$("#carrito").on("click", 'a', function(e) {
			e.preventDefault()
			let productId = $(e.currentTarget).closest('[id]').attr('product_id')
			var products = localStorage.getItem('products') != null ? JSON.parse(localStorage.getItem('products')) : [];
			products.filter(el => el.id !== productId)
			localStorage.setItem('products', JSON.stringify(products));
			$("#carrito").html("")
			showCarrito()
		});
	</script>
@endpush