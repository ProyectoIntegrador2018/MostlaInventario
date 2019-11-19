@extends('layouts.app')

@section('content')
<section>
    <div class="title-bar">
        <h1>Productos</h1>

    </div>
    <form action="/products" class="inline-form">
        @csrf
        <div class="row">
            <div class="col">
                <input id="search" class="form-control" type="text" name="search" placeholder="Buscar">
            </div>
            <div class="col">
                <select name="categories" multiple title="Categorías" class="selectpicker form-control" data-selected-text-format="count > 1">
                    <option hidden disabled value="">Categorías</option>
                    @foreach($categories as $category)
                    <option value={{$category->id}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="technology" multiple title="Tags" class="selectpicker form-control" data-selected-text-format="count > 1">
                    <option hidden disabled value="">Tags</option>
                    @foreach($tags as $tag)
                    <option value={{$tag->id}}>{{$tag->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <button id="catalog-consultar" type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <a class="float-right" href="/product/create">Crear +</a>
    <div class="table-container">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Información</th>
                <th>Edición</th>
                <th>Disponible</th>
            </tr>
            @forelse($productsIndex as $product)
            <tr>
                <td>
                    <span class="subtle">{{$product->brand}}</span>
                    {{$product->name}}
                </td>
                <td>{{$product->description}}</td>
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
