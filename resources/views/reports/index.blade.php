@extends('layouts.app')

@section('content')
	@component('layouts.frame', [
		'title' => 'Reportes',
	])

	<form action="/reports" class="inline-form">
		<div class="row">
			<div class="col">
				<select name="type" title="Tipo de Reporte" class="selectpicker form-control" required>
					@foreach($types as $type)
						<option value="{{ $loop->iteration }}" {{ $loop->iteration == ($filters['type'] ?? -1) ? 'selected' : '' }}>{{ $type }}</option>
					@endforeach
				</select>
			</div>
			<div class="col">
				<input class="form-control" type="date" name="start" value="{{ $filters['start'] ?? '' }}">
			</div>
			<div class="col">
				<input class="form-control" type="date" name="end" value="{{ $filters['end'] ?? '' }}">
			</div>

			<div class="col">
				<button id="catalog-consultar" type="submit" class="btn btn-primary btn-sm ">Buscar</button>
			</div>
			@superadmin
			<div class="col">
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" name="all_campus" id="allCheck">
				  <label class="form-check-label" for="allCheck">
				    Todos los campus
				  </label>
				</div>
			</div>
			@endsuperadmin
			<div class="col">
				<button id="descargar" formaction="/reports/export" type="submit" class="btn btn-link">Exportar</button>
			</div>
		</div>
	</form>

	<div class="table-container">
		<table>
			<tr>
				@foreach($headings as $heading)
					<th>{{ $heading }}</th>
				@endforeach
			</tr>
			@forelse($results as $result)
			<tr>
				@foreach($result as $value)
					<td>{{ $value }}</td>
				@endforeach
			</tr>
			@empty
				@if(empty($filters))
					<td class="empty">Seleccione un reporte.</tr>
				@else
					<td class="empty" colspan="{{sizeof($headings)}}">No hay resultados.</tr>
				@endif
			@endforelse
		</table>
	</div>
	@endcomponent
@endsection

@push('scripts')
@endpush
