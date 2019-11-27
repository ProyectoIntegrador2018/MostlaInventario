@extends('layouts.app')

@section('content')
<section>
    <div class="title-bar">
        <h1>Productos</h1>

    </div>
    <form class="inline-form">
        <div class="row">
            <div class="col">
                <input id="search" class="form-control" type="text" name="search" placeholder="Buscar" value="{{ old('search') }}">
            </div>
            <div class="col">
                <select name="categories[]" multiple title="Categorías" class="selectpicker form-control" data-selected-text-format="count > 1">
                    @foreach($categories as $category)
                    <option value={{$category->id}} {{ in_array($category->id, old('categories') ?? []) ? 'selected' : '' }}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="tags[]" title="Seleccione tags" multiple title="Tags" class="selectpicker form-control" data-selected-text-format="count > 1">
                    @foreach($tags as $tag)
                    <option value={{$tag->id}} {{ in_array($tag->id, old('tags') ?? []) ? 'selected' : '' }}>{{$tag->name}}</option>
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
