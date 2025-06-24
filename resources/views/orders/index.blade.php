@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif
@extends('layout')

@section('content')
<h2>All Orders</h2>

<form method="GET" action="{{ route('orders.index') }}">
    <label>Customer Name:</label>
    <input type="text" name="customer_name" value="{{ request('customer_name') }}">

    <label>From Date:</label>
    <input type="date" name="from_date" value="{{ request('from_date') }}">

    <label>To Date:</label>
    <input type="date" name="to_date" value="{{ request('to_date') }}">

    <button type="submit">Filter</button>
</form>

<br>

<table border="1" cellpadding="5">
    <tr>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Total Amount</th>
        <th>Total Products</th>
    </tr>
    @foreach($orders as $order)
        @php
            $total = $order->orderItems->sum('price');
            $count = $order->orderItems->sum('quantity');
        @endphp
        <tr>
            <td>{{ $order->customer_name }}</td>
            <td>{{ $order->order_date }}</td>
            <td>₹{{ $total }}</td>
            <td>{{ $count }}</td>
        </tr>
        {{-- <tr>
            <td colspan="4">
                <strong>Products Ordered:</strong>
                <ul>
                    @foreach($order->orderItems as $item)
                        <li>{{ $item->product->name }} — Qty: {{ $item->quantity }}</li>
                    @endforeach
                </ul>
            </td>
        </tr> --}}

    @endforeach
</table>
@endsection
