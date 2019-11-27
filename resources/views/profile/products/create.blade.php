@extends('layouts.app')

@section('content')
<section>
  <h1>Crear Producto</h1>
  <a href="/products">< Regresar</a>
  @if ($errors->any())
  <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
  @endif

      <form action="/product/store" class="inline-form" method="POST">
        @csrf
        <div class="form-group">
          <label for="name">Nombre</label>
          <input type="text" name="name" class="filtering form-control" id="name" placeholder="Nombre del Producto">
          <small id="emailHelp" class="form-text text-muted">Puede buscar el producto en la sección inferior para evitar duplicados.</small>
        </div>
        <div class="form-group">
          <label for="model">Modelo</label>
          <input type="text" name="model" class="filtering form-control" id="model" placeholder="Modelo del Producto">
        </div>
        <div class="form-group">
          <label for="brand">Marca</label>
          <input type="text" name="brand" class="filtering form-control" id="brand" placeholder="Marca">
        </div>
        <div class="form-group">
          <label for="description">Descripción del Producto</label>
          <input type="textarea" name="description" class="form-control" id="description" placeholder="Descripción...">
        </div>
        <div class="form-group">
          <label for="category">Categoría</label>
          <select id="category" name="category_id" title="Seleccione una categoría" class="selectpicker form-control">
              @foreach($categories as $category)
                  <option value={{ $category->id }}>{{ $category->name }}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="tags">Tags</label>
          <select id="tags" name="tags[]" title="Seleccione tags" class="selectpicker form-control" multiple>
              @foreach($tags as $tag)
                  <option value={{ $tag->id }}>{{ $tag->name }}</option>
              @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
      </form>
    </section>

    <section>
      <h3>¿Ya existe el producto?</h3>
      <table>
        @forelse($products as $product)
          <tr class="clickable_t filterable" data-href="/product/attach/{{$product->id}}">
            <td>
              <span class="subtle">{{$product->brand}}</span>
              {{$product->name}}
              <span hidden>{{ $product->model }}</span>
            </td>
          </tr>
        @empty
          <tr>
            <td class="empty">No hay productos registrados actualmente.</td>
          </tr>
        @endforelse
      </table>
    </section>
@endsection

@push('scripts')
<script type="text/javascript">
        // Filter list of existing products based on user's input
        $('.filtering').on('change paste keyup', function(event){
          let newValue = $(event.target).val().toLowerCase();
          $('.filterable').each(function(index, item){
            let productName = $(item).text().toLowerCase();
            if (productName.indexOf(newValue) >= 0) {
              $(item).show();
            } else {
              $(item).hide();
            }
          });
        });

        $(".clickable_t").click(function () {
          window.location = $(this).data('href');
        });
    </script>
@endpush
