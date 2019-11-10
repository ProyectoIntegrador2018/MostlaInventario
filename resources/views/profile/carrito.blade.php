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
			var innerCarrito = ""
			for(let i=0; i<sessionStorage.length; i++) {
			  let key = sessionStorage.key(i)
			  let product = JSON.parse(sessionStorage.getItem(key))
			  innerCarrito += `<div id='${product.p_id}' class='card'><div class='card-title'>${product.p_name}<p><a href='#'>Eliminar</a></p></div><div class='card-body'><div> Inicio: <input type='date'> Fin: <input type='date'> </div> Cantidad: <input type='number' min='1'> </div> </div>`
			}
			$("#carrito").append(innerCarrito)	
		}
		showCarrito()
		$("#carrito").on("click", 'a', function(e) {
			e.preventDefault()
			let productId = $(e.currentTarget).closest('[id]').attr('id')
			sessionStorage.removeItem(productId)
			$("#carrito").html("")
			showCarrito()
		});
	</script>
@endpush