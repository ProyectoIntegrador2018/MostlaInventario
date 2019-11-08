@extends('layouts.app')

@section('content')
	<h1>Tags</h1>
	<ul>
		@foreach($tags as $tag)
		<li>
			{{ $tag->name }}
		</li>
		@endforeach
	</ul>
@endsection