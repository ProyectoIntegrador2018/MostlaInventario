@extends('layouts.app')

@section('content')
	<form action="/roles" method="POST">
		@csrf
		<label for="email">email</label>
		<input id="email" type="email" name="email">
		<label for="type">type</label>
		<select id="type" name="type_id">
			@foreach($types as $type)
				<option value={{$type->id}}>{{$type->title}}</option>
			@endforeach			
		</select>
		@if($admin_general)
			<label for="campus">campus</label>
			<select id="campus" name="campus_id">
				@foreach($campus as $c)
					<option value={{$c->id}}>{{$c->name}}</option>
				@endforeach			
			</select>
		@endif
		<input type="submit" value="Guardar">
	</form>

	<table>
		<tr>
			<th>User</th>
			<th>Role</th>
			@if($admin_general)
				<th>Campus</th>
			@endif
		</tr>
		@foreach($roles as $role)
			<tr>
				<td>{{$role->email}}</td>
				<td>
					<form action="/roles/update/type/{{$role->id}}" method="POST">
						@csrf
						<select name="type_id" onchange="this.form.submit()">
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
							<select name="campus_id" onchange="this.form.submit()">
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
						<input type="submit" value="Borrar">
					</form>
				</td>
			</tr>
		@endforeach
	</table>
@endsection