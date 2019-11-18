<section>
	<div class="title-bar">
	    <h1>{{ $title ?? '' }}</h1>
    	@foreach($options ?? [] as $option)
	    	<a class="float-right" href="{{ $option['link'] }}">{{ $option['name'] }}</a>
	    @endforeach
	</div>

	{{ $slot }}
</section>