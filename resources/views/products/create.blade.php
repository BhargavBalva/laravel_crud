@extends('layout')

@section('content')
<h2>Add New Product</h2>

@if($errors->any())
    @foreach($errors->all() as $error)
        <p style="color: red">{{ $error }}</p>
    @endforeach
@endif

<form method="POST" action="{{ route('products.store') }}">
    @csrf
    <label>Name:</label><br>
    <input type="text" name="name"><br><br>
    
    <label>Price:</label><br>
    <input type="number" name="price" step="0.01"><br><br>

    <button type="submit">Save</button>
</form>
@endsection
