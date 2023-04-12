<?php

namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\UserRequest;
use App\Models\Order;
use App\Models\User;


class StoreController extends Controller
{
    public function __invoke(StoreRequest $request){
        $this->authorize('create',auth()->user());
        $validator = $request->validated();
        $order = Order::create($validator);
        $order->dishes()->attach();
        if ($order){
            return response()->json([
                'status' => 200,
                'message' => "Заказ успешно создан"
            ],200);
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Ошибка создания заказа'
            ],500);
        }
    }
}
