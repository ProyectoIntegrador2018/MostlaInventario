@extends('layouts.app')

@section('content')
<section>
  <h1>Editar Equipo</h1>
  @if ($errors->any())
  <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
  @endif
  <a href="/products/{{ $productEdit->id }}"> < Regresar</a>

      <form action="/product/update/{{$productEdit->id}}" class="inline-form" method="POST">
        @csrf
        <div class="form-group">
          <label for="name">Nombre</label>
          <input type="text" name="name" class="form-control" id="name" placeholder="Nombre del Equipo" value="{{$productEdit->name}}">
        </div>
        <div class="form-group">
          <label for="model">Modelo</label>
          <input type="text" name="model" class="form-control" id="model" placeholder="Modelo del Equipo" value="{{$productEdit->model}}">
        </div>
        <div class="form-group">
          <label for="brand">Marca</label>
          <input type="text" name="brand" class="form-control" id="brand" placeholder="Marca" value="{{$productEdit->brand}}">
        </div>
        <div class="form-group">
          <label for="description">Descripción del Equipo</label>
          <input type="textarea" name="description" class="form-control" id="description" placeholder="Descripción..." value="{{$productEdit->description}}">
        </div>
        <div class="form-group">
          <label for="category">Categoría</label>
          <select id="category" title="Seleccione una categoría" name="category_id" class="selectpicker form-control">
              @foreach($categories as $category)
                  <option value={{ $category->id }} {{ $category->id == $productEdit->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="tags">Tags</label>
          <select id="tags" name="tags[]" title="Seleccione tags" class="selectpicker form-control" multiple>
              @foreach($tags as $tag)
                  <option value={{ $tag->id }} {{ in_array($tag->id, $ptags) ? 'selected' : '' }}>{{ $tag->name }}</option>
              @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
    </section>
@endsection
