<?php

namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;


use App\Models\Order;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Carbon;


class ShowController extends Controller
{
    public function __invoke($id){
        $this->authorize('view',Order::class);
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
