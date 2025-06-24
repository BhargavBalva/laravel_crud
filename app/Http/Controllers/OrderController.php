<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with('orderItems');

        // Optional: Filter by customer name
        if ($request->filled('customer_name')) {
            $query->where('customer_name', 'like', '%' . $request->customer_name . '%');
        }

        // Optional: Filter by date range
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('order_date', [$request->from_date, $request->to_date]);
        }

        $orders = $query->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'order_date' => 'required|date',
            'after_or_equal:today',
            'products.*' => 'required|exists:products,id',
            'quantities.*' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'order_date' => $request->order_date,
        ]);

        foreach ($request->products as $index => $product_id) {
            $product = Product::find($product_id);
            $qty = $request->quantities[$index] ?? 1;

            $price = $product->price * $qty;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product_id,
                'quantity' => $qty,
                'price' => $price,
            ]);
        }
        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
