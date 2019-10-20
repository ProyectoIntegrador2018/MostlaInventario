@extends('layouts.app')
@section('content')
<table>
		<tr>
			<th>Id</th>
			<th>Name</th>
		</tr>
		@foreach($products as $product)
			<tr>
				<td>
					{{$product->id}}
				</td>
				<td>
					{{$product->name}}
				</td>
				<td>
					<form action="/maintenance/units/{{$product->id}}" id="listUnits">
						@csrf
						<input type="submit" value="Consultar">
					</form>
				</td>
			</tr>
		@endforeach
	</table>
@endsection