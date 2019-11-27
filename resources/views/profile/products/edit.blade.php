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
          <label for="name">Nombre</label>
          <input type="text" name="name" class="form-control" id="name" placeholder="Nombre del Producto" value="{{$productEdit->name}}">
        </div>
        <div class="form-group">
          <label for="model">Modelo</label>
          <input type="text" name="model" class="form-control" id="model" placeholder="Modelo del Producto" value="{{$productEdit->model}}">
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
          <select id="category" name="category_id" class="selectpicker form-control">
              <option selected hidden disabled>Seleccione una categoría</option>
              @foreach($categories as $category)
                  <option value={{ $category->id }} {{ $category->id == $productEdit->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="tags">Tags</label>
          <select id="tags" name="tags[]" class="selectpicker form-control" multiple>
              <option selected hidden disabled>Seleccione tags</option>
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
              <th>Comentario</th>
              <th>Edición</th>
              <th>Disponible</th>
              <th>Mantenimiento</th>
          </tr>
          @forelse($units as $unit)
          <tr>
              <td>{{$unit->serial_number}}</td>
              <td>
                @switch($unit->status)
                @case('available')
                  <i class="far fa-circle" title="Disponible"></i>
                @break
                @case('unavailable')
                  <i title="Prestado" class="fas fa-hand-holding-heart"></i>
                @break
                @case('maintenance')
                  <i title="En Mantenimiento" class="fas fa-hammer"></i>
                @break
                @endswitch
              </td>
              <td><span class="subtle">{{$unit->comments}}</span></td>
              <td><a href="/unit/edit/{{ $unit->id }}">Editar</a></td>
              <td><a href="/unit/delete/{{ $unit->id }}">Eliminar</a></td>
              <td>
                @if($unit->status == 'available')
                  <a href="/maintenances/create/{{ $unit->id }}">Iniciar</a>
                @endif
              </td>
          </tr>
          @empty
            <td class="empty" colspan="6">No hay unidades por el momento</td>
          @endforelse
      </table>
    </section>
@endsection
