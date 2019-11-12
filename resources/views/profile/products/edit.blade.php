@extends('layouts.app')

@section('content')
    <section>
      <h1>Editar Producto</h1>
      @if ($errors->any())
          <ul>
              @foreach($errors->all() as $error)
              <li>{{$error}}</li>
              @endforeach
          </ul>
      @endif
      <a href="{{ url()->previous() }}"> < Regresar</a>

      <form action="/product/update/{{$productEdit->id}}" class="inline-form" method="POST">
        @csrf
        <div class="form-group">
          <label for="name">Modelo</label>
          <input type="text" name="name" class="form-control" id="name" placeholder="Nombre del Modelo" value="{{$productEdit->name}}">
        </div>
        <div class="form-group">
          <label for="brand">Marca</label>
          <input type="text" name="brand" class="form-control" id="brand" placeholder="Marca" value="{{$productEdit->brand}}">
        </div>
        <div class="form-group">
          <label for="description">Descripción del Producto</label>
          <input type="textarea" name="description" class="form-control" id="description" placeholder="Descripción..." value="{{$productEdit->description}}">
        </div>
        <div class="form-group">
          <label for="category">Categoría</label>
          <select id="category" name="category_id" class="form-control">
              <option selected hidden disabled>Seleccione una categoría</option>
              @foreach($categories as $category)
                  <option value={{ $category->id }} {{ $category->id == $productEdit->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
              @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
    </section>
@endsection
