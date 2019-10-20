@extends('layouts.app')

@section('content')
	<h1>Crear Producto</h1>
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <a href="/products">Regresar</a>
    <br><br>
    <form action="/product/store">
        Nombre:<br>
        <input id="name" type="text" name="name" value="" /><br>
        Marca:<br>
        <input type="text" name="brand" value="" /><br>
        Descripción:<br>
        <input type="textarea" name="description" value="" /><br>
        Categoria:<br>
        <select name="category_id">
            <option selected hidden disabled>Seleccione una categoría</option>
            @foreach($categories as $category)
                <option value={{ $category->id }}>{{ $category->name }}</option>
            @endforeach
        </select>
        <br>
        <input type="submit" value="Submit">
    </form>
    
    <h3>Ya existe el producto?</h3>
    <ul id="existing">
        @foreach($products as $product)
            <li><a href="/products/attach/{{$product->id}}">
                <span>{{$product->brand}}</span> {{$product->name}}
            </a></li>
        @endforeach
    </ul>
@endsection

@push('scripts')
    <script type="text/javascript">
        // Filter list of existing products based on user's input
        $('#name').on('change paste keyup', function(event){
            let newValue = $('#name').val().toLowerCase();
            $('#existing').children().each(function(index, item){
                let productName = $(item).text().toLowerCase();
                if (productName.indexOf(newValue) >= 0) {
                    $(item).show();
                } else {
                    $(item).hide();
                }
            });
        });
    </script>
@endpush