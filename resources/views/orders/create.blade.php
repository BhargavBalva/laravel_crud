@extends('layout')

@section('content')
<h2>Create New Order</h2>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <p style="color: red">{{ $error }}</p>
    @endforeach
@endif

<form method="POST" action="{{ route('orders.store') }}">
    @csrf

    <label>Customer Name:</label><br>
    <input type="text" name="customer_name"><br><br>

    <label>Order Date:</label><br>
    <input type="date" name="order_date" min="{{ date('Y-m-d') }}"><br><br>

    <h4>Order Items:</h4>

    @for($i = 0; $i < 2; $i++) {{-- 2 minimum rows --}}
        <label>Product:</label>
        <select name="products[]">
            <option value="">-- Select --</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }} - ₹{{ $product->price }}</option>
            @endforeach
        </select>

        <label>Qty:</label>
        <input type="number" name="quantities[]" min="1" value="1"><br><br>
    @endfor

    <button type="submit">Place Order</button>
</form>
@endsection
