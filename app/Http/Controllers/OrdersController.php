<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class OrdersController extends Controller
{
    public function create(Request $request)
    {
        $newOrder = Order::create([
            'user_id' => $request->user_id,
            'total_amount' => $request->total_amount,
            'status' => $request->status
        ]);

        broadcast(new OrderCreated($newOrder))->toOthers();

        return response()->json(['data' => $newOrder, 'status' => 'Order created successfully', 'broadcasted' => true], 200);
    }

    public function getUserOrders(User $user)
    {
        $userOrders = $user->orders;

        return response()->json(['status' => true, 'data' => $userOrders], 200);
    }
}
