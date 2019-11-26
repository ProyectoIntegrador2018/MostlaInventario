@extends('layouts.app')

@section('content')
<section>
	<h1>Mantenimientos Actuales</h1>
	<div class="table-container">
		<table>
			<tr>
				<th>Product</th>
				<th>Unit</th>
				<th>Comentario</th>
				<th>Fecha</th>
				<th>Status</th>
			</tr>
			@foreach($maintenances as $maintenance)
			<tr>
				<td>{{$maintenance->unit->product->name}}</td>
				<td>{{$maintenance->unit->serial_number}}</td>
				<td>{{$maintenance->comment}}</td>
				<td>{{$maintenance->created_at}}<</td>
				<td>
					<form action="/maintenances/update/status/{{$maintenance->id}}" method="POST">
						@csrf
						<select name="status" title="Status" class="selectpicker form-control" onchange="this.form.submit()">
							@foreach(json_decode($status) as $st)
							<option value={{ $st->id }} {{ $st->name == $maintenance->unit->status ? 'selected' : '' }}>{{ $st->name }}</option>
							@endforeach		
						</select>
					</form>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
</section>
@endsection