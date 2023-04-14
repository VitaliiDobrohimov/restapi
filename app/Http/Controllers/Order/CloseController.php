<?php

namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateRequest;
use App\Http\Requests\UserRequest;
use App\Models\Order;
use App\Models\User;


class CloseController extends Controller
{
    public function __invoke($id){

        $this->authorize('update',auth()->user());

        $order = Order::find($id);
        if ($order){
            $order->update([
                'is_closed'=> 1,
                'date_closed'=>now()
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Заказ под номером ' . $id . ' закрыт',
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
