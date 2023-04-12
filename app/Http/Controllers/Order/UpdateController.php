<?php

namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;

use App\Http\Requests\Order\UpdateRequest;
use App\Models\Order;
use App\Models\User;


class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, int $id){
        $this->authorize('view',auth()->user());
        $validator = $request->validated();
        $order = Order::findOrFail($id);
        if ($order)
        {
            $order->update($validator);
            return response()->json([
                'status' => 200,
                'message' => "Заказ успешно обновлен"
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Ошибка обновления заказа'
            ],404);
        }

    }



}
