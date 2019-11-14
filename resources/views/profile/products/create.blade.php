@extends('layouts.app')

@section('content')
<section>
  <h1>Crear Producto</h1>
  <a href="/products">Regresar</a>
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
      <label for="name">Modelo</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Nombre del Modelo">
      <small id="emailHelp" class="form-text text-muted">Puede buscar el producto en la sección inferior para evitar duplicados.</small>
    </div>
    <div class="form-group">
      <label for="brand">Marca</label>
      <input type="text" name="brand" class="form-control" id="brand" placeholder="Marca">
    </div>
    <div class="form-group">
      <label for="description">Descripción del Producto</label>
      <input type="textarea" name="description" class="form-control" id="description" placeholder="Descripción...">
    </div>
    <div class="form-group">
      <label for="category">Categoría</label>
      <select id="category" name="category_id" class="selectpicker form-control">
        <option selected hidden disabled>Seleccione una categoría</option>
        @foreach($categories as $category)
        <option value={{ $category->id }}>{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="tags">Tags</label>
      <select id="tags" name="tags[]" class="selectpicker form-control" multiple title="Seleccione Tags">
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
  <div class="table-container">
    <table>
      @forelse($products as $product)
      <tr class="clickable_t filterable" data-href="/product/attach/{{$product->id}}">
        <td>
          <span class="subtle">{{$product->brand}}</span> 
          {{$product->name}}
        </td>
      </tr>
      @empty
      <tr>
        <td class="empty">No hay productos registrados actualmente.</td>
      </tr>
      @endforelse
    </table>
  </div>
</section>
@endsection

@push('scripts')
<script type="text/javascript">
        // Filter list of existing products based on user's input
        $('#name').on('change paste keyup', function(event){
          let newValue = $('#name').val().toLowerCase();
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