<body>
    <nav>
        <a href="{{ route('products.index') }}">Products</a> |
        <a href="{{ route('orders.create') }}">Add Order</a> |
        <a href="{{ route('orders.index') }}">All Orders</a>
    </nav>
    <hr>
    @yield('content')
</body>
