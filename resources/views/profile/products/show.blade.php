@extends('layouts.app')

@section('content')
<section>
	<h1>Detalle de equipo: <b>{{$product->name}}</b></h1>

	<a href="/products"> < Regresar</a>
	<a class="float-right" href="/product/edit/{{ $product->id }}">Editar</a>
	<br>

	<div class="box">
		<div class="row">
			<div class="col">
				<h5>Nombre</h5>
			</div>
			<div class="col">
				<body>{{$product->name}}</body>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<h5>Modelo</h5>
			</div>
			<div class="col">
				<body>{{$product->model}}</body>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<h5>Marca</h5>
			</div>
			<div class="col">
				<body>{{$product->brand}}</body>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<h5>Descripcion del equipo</h5>
			</div>
			<div class="col">
				<body>{{$product->description}}</body>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<h5>Categoria</h5>
			</div>
			<div class="col">
				<body>{{$product->category->name}}</body>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<h5>Tags</h5>
			</div>
			<div class="col">
			<ul>
				@foreach($product->tags as $tag)
					<li>{{ $tag->name }}</li>
				@endforeach
			</ul>
			</div>
		</div>
	</div>
</section>

<section>
      <h1>Unidades</h1>
      <a class="float-right" href="/unit/create">Agregar Unidad +</a>
      <table>
          <tr>
              <th>Número serial</th>
              <th>Status</th>
              <th>Comentario</th>
              <th>Edición</th>
              <th>Disponible</th>
              <th>Mantenimiento</th>
          </tr>
          @forelse($product->units as $unit)
          <tr>
              <td>{{$unit->serial_number}}</td>
              <td>
                @switch($unit->status)
                @case(App\Models\Unit::AVAILABLE)
                  <i class="far fa-circle" title="Disponible"></i>
                @break
                @case(App\Models\Unit::UNAVAILABLE)
                  <i title="Prestado" class="fas fa-hand-holding-heart"></i>
                @break
                @case(App\Models\Unit::MAINTENANCE)
                  <i title="En Mantenimiento" class="fas fa-hammer"></i>
                @break
                @endswitch
              </td>
              <td><span class="subtle">{{$unit->comments}}</span></td>
              <td><a href="/unit/edit/{{ $unit->id }}">Editar</a></td>
              <td><a href="/unit/delete/{{ $unit->id }}">Eliminar</a></td>
              <td>
                @if($unit->status == App\Models\Unit::AVAILABLE)
                  <a href="/maintenances/create/{{ $unit->id }}">Iniciar</a>
                @endif
              </td>
          </tr>
          @empty
            <td class="empty" colspan="6">No hay unidades por el momento</td>
          @endforelse
      </table>
    </section>
@endsection
