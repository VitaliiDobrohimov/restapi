<?php

namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Order;
use App\Models\User;


class EditController extends Controller
{
    public function __invoke($id){
        $this->authorize('view',auth()->user());
        $order = Order::find($id);
        if ($order){
            return response()->json([
                'status' => 200,
                'user' => $order,
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
