@extends('layout')

@section('content')
<h2>Edit Product</h2>

@if($errors->any())
    @foreach($errors->all() as $error)
        <p style="color: red">{{ $error }}</p>
    @endforeach
@endif

<form method="POST" action="{{ route('products.update', $product) }}">
    @csrf
    @method('PUT')

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ $product->name }}"><br><br>

    <label>Price:</label><br>
    <input type="number" name="price" value="{{ $product->price }}" step="0.01"><br><br>

    <button type="submit">Update</button>
</form>
@endsection
