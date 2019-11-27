@extends('layouts.app')

@section('content')

<section>
	<h1>Categorías</h1>
    <a class="float-right" href="/category/create">Crear +</a>
    <table >
        <tr>
            <th>Nombre</th>
            <th>Edición</th>
            <th>Disponible</th>
        </tr>
        @forelse($categoriesIndex as $category)
        <tr>
            <td>{{$category->name}}</td>
            <td><a href="/category/edit/{{ $category->id }}">Editar</a></td>
            @if($category->deleted_at != null)
              <td><a href="/category/activate/{{ $category->id }}">Activar</a></td>
            @else
              <td><a href="/category/delete/{{ $category->id }}">Eliminar</a></td>
            @endif
        </tr>
        @empty
            <td class="empty" colspan="3">Por el momento no hay categorías.</td>
        @endforelse
    </table>
</section>
@endsection
