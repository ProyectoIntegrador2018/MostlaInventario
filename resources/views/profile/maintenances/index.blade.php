@extends('layouts.app')

@section('content')
<section>
	<h1>Mantenimientos Actuales</h1>
	<div class="table-container">
		<table>
			<tr>
				<th>Equipo</th>
				<th>No. Serie</th>
				<th>Comentario</th>
				<th>Desde</th>
				<th>Terminar</th>
				<th>Eliminar</th>
			</tr>
			@forelse($maintenances as $maintenance)
			<tr>
				<td>
					<span class="subtle">{{ $maintenance->unit->product->brand }}</span>
					{{$maintenance->unit->product->name}}
				</td>
				<td>{{$maintenance->unit->serial_number}}</td>
				<td><span class="subtle">{{$maintenance->comment}}</span></td>
				<td>{{$maintenance->created_at->format('d/M/Y h:i A')}}</td>
				<td>
					<form action="/maintenances/finish/{{$maintenance->id}}" method="POST">
						@csrf
						<input type="submit" value="Dar de alta" class="btn btn-link">
					</form>
				</td>
				<td>
					<form action="/maintenances/delete/{{$maintenance->id}}" method="POST">
						@csrf
						<input type="submit" value="Eliminar Unidad" class="btn btn-link">
					</form>
				</td>
			</tr>
			@empty
				<td class="empty" colspan="6">Por el momento no hay unidades en mantenimiento.</td>
			@endforelse
		</table>
	</div>
</section>
@endsection