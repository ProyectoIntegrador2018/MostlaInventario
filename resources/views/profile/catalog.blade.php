@extends('layouts.app')

@section('content')
<section>
    <div class="title-bar">
		<h1>Catálogo de Reservaciones</h1>
		<a href="/canasta">{{ $cart->count() ?: '' }}  <i class="fas fa-shopping-basket fa-2x"></i></a>
    </div>

	<form class="inline-form">
		<div class="row">
			<div class="col">
				<input id="search" class="form-control" type="text" name="search" placeholder="Buscar" value="{{ old('search') }}">
			</div>
			<div class="col">
				<select name="categories[]" multiple title="Categorías" class="selectpicker form-control" data-selected-text-format="count > 1">
					@foreach($categories as $category)
					<option value={{$category->id}} {{ in_array($category->id, old('categories') ?? []) ? 'selected' : '' }}>{{$category->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="col">
				<select name="tags[]" title="Seleccione tags" multiple title="Tags" class="selectpicker form-control" data-selected-text-format="count > 1">
					@foreach($tags as $tag)
					<option value={{$tag->id}} {{ in_array($tag->id, old('tags') ?? []) ? 'selected' : '' }}>{{$tag->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="col">
				<button id="catalog-consultar" type="submit" class="btn btn-primary">Filtrar</button>
			</div>
		</div>
	</form>

	<div class= "box container">
		<div class = "row">
			@forelse($products as $product)
				<div class= "col">
					<div class="card-deck classWithPad">
						<div class="card-body">
							<h5 class="card-title">
								<span class="subtle">{{ $product->brand }}</span>
								{{ $product->name }}
							</h5>
							<p class="card-text">{{ $product->description }}</p>
							<h6 class="card-subtitle mb-2 text-muted">{{ $product->tags()->pluck('name')->join(', ') }}</h6>
							@if($cart->contains($product->id))
								<form action="/cart/remove/{{ $product->id }}">
									<button type="submit" class="btn btn-light btn-sm add-to-cart">Quitar de canasta</button>
								</form>
							@else
								<form action="/cart/add/{{ $product->id }}">
									<button type="submit" class="btn btn-secondary btn-sm add-to-cart">Agregar a canasta</button>
								</form>
							@endif
						</div>
					</div>
				</div>
				@if(!$loop->iteration % 3 && !$loop->last)
					</div>
					<div class="row">
				@endif
			@empty
				<div class="table-container">
					<table>
						<td class="empty">No hay productos disponibles por el momento.</tr>
					</table>
				</div>
			@endforelse
		</div>
	</div>

</section>

@endsection