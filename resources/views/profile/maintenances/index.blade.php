@extends('layouts.app')

@section('content')
	<section>
	<h1>Mantenimientos Actuales</h1>
	<table>
			<tr>
				<th>Product</th>
				<th>Unit</th>
				<th>Fecha</th>
				<th></th>
			</tr>
			@foreach($maintenances as $maintenance)
				<tr>
					<td>{{$maintenance->unit()->product()->name}}</td>
					<td>{{$maintenance->unit()->serial_number}}</td>
					<td>{{$maintenance->created_at}}<</td>
					<td>
						<form action="/roles/update/status/{{$maintenance->id}}" method="POST">
							@csrf
							<select name="status" title="Status" class="selectpicker form-control" onchange="this.form.submit()">
								@foreach($status as $st)
				                  <option value={{ $st->id }} {{ $st->id == $maintenance->status ? 'selected' : '' }}>{{ $st->name }}</option>
				              	@endforeach		
							</select>
						</form>
					</td>
				</tr>
			@endforeach
		</table>
	</section>
@endsection