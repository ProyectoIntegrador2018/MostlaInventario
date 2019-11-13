@extends('layouts.app')

@section('content')
<section>
	<h1>Nuevo Rol</h1>
	<form action="/roles" method="POST" class="inline-form">
		@csrf
		<div class="row">
			<div class="col">
				<input id="email" class="form-control" type="email" name="email" placeholder="Email">
			</div>
			<div class="col">
				<select id="type" name="type_id" title="Tipo" class="selectpicker form-control" data-selected-text-format="count > 1">
					<option hidden disabled value="">Tipo</option>
					@foreach($types as $type)
					<option value={{$type->id}}>{{$type->title}}</option>
					@endforeach			
				</select>
			</div>
			@if($admin_general)
			<div class="col">
				<select id="campus" name="campus_id" title="Campus" class="selectpicker form-control" data-selected-text-format="count > 1">
					<option hidden disabled value="">Campus</option>
					@foreach($campus as $c)
					<option value={{$c->id}}>{{$c->name}}</option>
					@endforeach			
				</select>
			</div>
			@endif
			<div class="col">
				<button type="submit" class="btn btn-primary small-button">Guardar</button>
			</div>
		</div>
	</form>
	<div class="table-container">
		<table>
			<tr>
				<th>User</th>
				<th>Role</th>
				@if($admin_general)
				<th>Campus</th>
				@endif
				<th></th>
			</tr>
			@foreach($roles as $role)
			<tr>
				<td>{{$role->email}}</td>
				<td>
					<form action="/roles/update/type/{{$role->id}}" method="POST">
						@csrf
						<select name="type_id" title="Tipo" class="selectpicker form-control" data-selected-text-format="count > 1" onchange="this.form.submit()">
							@foreach($types as $type)
							<option value={{$type->id}} {{ $role->type_id == $type->id ? 'selected' : '' }}>{{$type->title}}</option>
							@endforeach			
						</select>
					</form>
				</td>
				@if($admin_general)
				<td>
					<form action="/roles/update/campus/{{$role->id}}" method="POST">
						@csrf
						<select name="campus_id" title="Campus" class="selectpicker form-control" data-selected-text-format="count > 1" onchange="this.form.submit()">
							@foreach($campus as $c)
							<option value={{$c->id}} {{ $role->campus_id == $c->id ? 'selected' : '' }}>{{$c->name}}</option>
							@endforeach			
						</select>
					</form>
				</td>
				@endif
				<td>
					<form action="/roles/delete/{{$role->id}}" method="POST">
						@csrf
						<button type="submit" class="btn btn-link small-button">Eliminar</button>
					</form>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
</section>
@endsection