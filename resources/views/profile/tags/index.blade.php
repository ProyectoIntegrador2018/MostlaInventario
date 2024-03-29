@extends('layouts.app')

@section('content')
<section>
	<h1>Tags</h1>
    <a class="float-right" href="/tag/create">Crear +</a>
    <table >
        <tr>
            <th>Nombre</th>
            <th>Edición</th>
            <th>Disponible</th>
        </tr>
        @forelse($tags as $tag)
        <tr>
            <td>{{$tag->name}}</td>
            <td><a href="/tag/edit/{{ $tag->id }}">Editar</a></td>
            @if($tag->deleted_at != null)
              <td><a href="/tag/activate/{{ $tag->id }}">Activar</a></td>
            @else
              <td><a href="/tag/delete/{{ $tag->id }}">Eliminar</a></td>
            @endif
        </tr>
        @empty
            <td class="empty" colspan="3">Por el momento no hay tags.</td>
        @endforelse
    </table>
</section>
@endsection
