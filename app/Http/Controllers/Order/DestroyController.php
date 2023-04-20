<?php

namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Order;
use App\Models\User;


class DestroyController extends Controller
{
    public function __invoke($id){
        $this->authorize('delete',Order::class);
        $order = Order::find($id);
        if ($order){
            $order->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Заказ под номером ' . $id . 'удален',
                'user' => $order
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Ошибка нет такого заказа'
            ],404);
        }
    }
}
