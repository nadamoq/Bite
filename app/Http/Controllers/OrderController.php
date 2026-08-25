<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.menuitem_id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.special_instructions' => 'nullable|string|max:255',
        ]);

       
      $order = DB::transaction(function () use ($validated, $request) {

        // 1. حساب المجموع الكلي للطلب أولاً
        $totalPrice = collect($validated['items'])->sum(function ($item) {
            return $item['quantity'] * $item['unit_price'];
        });

        // 2. إنشاء الطلب الأساسي مع إضافة total_price له
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(6)),
            'order_type' => 'delivery',
            'user_id' => $request->user()->id ?? 1,
            'total_price' => $totalPrice, // <--- إسناد المجموع الكلي للطلب هنا
            'status' => 'pending',
        ]);

        // 3. Group and prepare order items (merge duplicate items with identical customizations)
        $groupedItems = [];
        foreach ($validated['items'] as $item) {
            $key = $item['menuitem_id'] . '_' . ($item['special_instructions'] ?? '');
            if (isset($groupedItems[$key])) {
                $groupedItems[$key]['quantity'] += $item['quantity'];
            } else {
                $groupedItems[$key] = [
                    'menuitem_id' => $item['menuitem_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'special_instructions' => $item['special_instructions'] ?? null,
                ];
            }
        }

        $orderItems = [];
        foreach ($groupedItems as $itemData) {
            $orderItems[] = new OrderItem($itemData);
        }

        // 4. Save items
        $order->items()->saveMany($orderItems);

        return $order;
    });
        return response()->json([
            'message' => 'success',
            'data' => $order->load('items')
        ], 201);
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
