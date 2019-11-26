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
        <div class="form-group">
          <label for="tags">Tecnologías</label>
          <select id="tags" name="tags[]" class="form-control" multiple>
              <option selected hidden disabled>Seleccione una tecnología</option>

              @foreach($tags as $tag)
                         <option value={{ $tag->id }} {{ in_array($tag->id, $ptags) ? 'selected' : '' }}>{{ $tag->name }}</option>
                     @endforeach

          </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
    </section>

    <section>
      <h1>Unidades</h1>
      <a class="float-right" href="/unit/create">Agregar Unidad +</a>
      <table>
          <tr>
              <th>Número serial</th>
              <th>Status</th>
              <th>Fecha de creación</th>
              <th>Edición</th>
              <th>Disponible</th>
              <th>Mantenimiento</th>
          </tr>
          @foreach($units as $unit)
          <tr>
              <td>{{$unit->serial_number}}</td>
              <td>{{$unit->status}}</td>
              <td>{{$unit->created_at}}</td>
              <td><a href="/unit/edit/{{ $unit->id }}">Editar</a></td>
              @if($unit->deleted_at != null)
                <td><a href="/unit/activate/{{ $unit->id }}">Activar</a></td>
              @else
                <td><a href="/unit/delete/{{ $unit->id }}">Eliminar</a></td>
              @endif
              <td><a href="/maintenances/create/{{ $unit->id }}">Agregar +</a></td>
          </tr>
          @endforeach
      </table>
    </section>
@endsection
