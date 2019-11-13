@extends('layouts.app')

@section('content')
<section>
    <h1>Mis Productos</h1>
    <a class="float-right" href="/product/create">Crear +</a>
    <div class="table-container">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Marca</th>
                <th>Categoría</th>
                <th>Información</th>
                <th>Edición</th>
                <th>Disponible</th>
            </tr>
            @forelse($productsIndex as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->brand}}</td>
                <td>{{$product->category->name}}</td>
                <td><a href="/products/{{ $product->id }}">Detalle</a></td>
                <td><a href="/product/edit/{{ $product->id }}">Editar</a></td>
                @if($product->deleted_at == null)
                <td><a href="/product/detach/{{ $product->id }}">Eliminar</a></td>
                @endif
            </tr>
            @empty
            <td class="empty" colspan="6">No hay productos en inventario.</td>
            @endforelse
        </table>
    </div>
</section>

@endsection
