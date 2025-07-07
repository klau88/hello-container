<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderApiController extends Controller
{
    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return Order::paginate(50);
    }

    /**
     * @param Request $request
     * @return Order
     */
    public function create(Request $request): Order
    {
        $order = Order::create([
            'bl_release_date' => $request->get('bl_release_date'),
            'bl_release_user_id' => $request->get('bl_release_user_id'),
            'freight_payer_self' => $request->get('freight_payer_self'),
            'contract_number' => $request->get('contract_number'),
            'bl_number' => $request->get('bl_number')
        ]);

        return $order;
    }
}
