@extends('layouts.app')

@section('content')


<section>
    <h1>Editar número de serie</h1>
    @if ($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <a href="{{ url()->previous() }}">< Regresar</a>
    <br>
    <form class="inline-form" action="/unit/update/{{$unitEdit->id}}">
        Producto:<br>

        <select disabled class="selectpicker form-control" name="product_id">
            <option value="{{$unitEdit->product_id}}">{{$unitEdit->product->name}}</option>
        </select>

        <br>
        <div>
            <br>
            Número serial:<br>
            <input type="text" class="form-control" name="serial_number" value="{{$unitEdit->serial_number}}"/><br>
            <span class="input-group-btn">
            Status:<br>
            <input type="text" class="form-control" name="status" value="{{$unitEdit->status}}" /><br>
            Comentario:<br>
            <textarea class="form-control" name="comments">{{$unitEdit->comments}}</textarea>
                <br>
                <input class="btn btn-primary" type="submit" value="Submit">
        </div>
    </form>

</section>

@endsection
