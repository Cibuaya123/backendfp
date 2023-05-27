<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $userId = Auth::id();

        $order = Order::create([
            'user_id' => $userId,
            'order_date' => $request->order_date,
            'total_amount' => $request->total_amount,
        ]);

        
        return redirect()->route('order.index')->with('success', 'Order berhasil dibuat');
    }
}