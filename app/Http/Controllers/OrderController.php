<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy('bl_release_date', 'desc')->paginate(50);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bl_release_date' => ['required', 'date'],
            'bl_release_user_id' => ['required', 'integer'],
            'freight_payer_self' => ['boolean'],
            'contract_number' => ['required', 'string', 'max:255'],
            'bl_number' => ['required', 'string', 'max:255'],
        ]);

        Order::create($validated);

        return redirect()->route('orders.create')->with('success', 'Order created.');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function unprocessed()
    {
        $orders = Order::where('notification_sent', true)
            ->orderBy('bl_release_date', 'desc')
            ->paginate(50);

        return view('orders.unprocessed', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
