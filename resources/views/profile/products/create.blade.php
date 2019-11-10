@extends('layouts.app')

@section('content')
    <section>
      <h1>Crear Producto</h1>
      @if ($errors->any())
          <ul>
              @foreach($errors->all() as $error)
              <li>{{$error}}</li>
              @endforeach
          </ul>
      @endif
      <a href="/products">Regresar</a>

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
          <select id="category" name="category_id" class="form-control">
              <option selected hidden disabled>Seleccione una categoría</option>
              @foreach($categories as $category)
                  <option value={{ $category->id }}>{{ $category->name }}</option>
              @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
      </form>
    </section>
        
    <section>
      <h3>¿Ya existe el producto?</h3>
      <table>
        @foreach($products as $product)
          <tr class="clickable_t filterable" data-href="/products/attach/{{$product->id}}">
            <td>
              <span class="subtle">{{$product->brand}}</span> 
              {{$product->name}}
            </td>
          </tr>
        @endforeach
      </table>
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