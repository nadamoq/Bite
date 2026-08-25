<?php

namespace App\Http\Controllers;

use App\Actions\Order\CreateOrderAction;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Store a newly created order in storage.
     */
    public function store(StoreOrderRequest $request, CreateOrderAction $createOrderAction): JsonResponse
    {
        $order = $createOrderAction->execute(
            data: $request->validated(),
            userId: $request->user()?->id
        );

        return response()->json([
            'message' => 'success',
            'data' => $order,
        ], 201);
    }
}
