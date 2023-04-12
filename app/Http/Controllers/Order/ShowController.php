<?php

namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;


use App\Models\Order;
use App\Models\User;


class ShowController extends Controller
{
    public function __invoke($id){
        $this->authorize('view',auth()->user());
        $order = Order::findOrFail($id);
        if ($order){
            return response()->json([
                'status' => 200,
                'order' => $order,
                'user'=> $order->user
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Нет заказа под таким номером'
            ],404);
        }
    }



}
