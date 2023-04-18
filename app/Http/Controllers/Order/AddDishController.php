<?php

namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;
use App\Http\Requests\Order\AddDishRequest;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\UserRequest;
use App\Models\Dish;
use App\Models\List_of_dishes;
use App\Models\Order;
use App\Models\User;
use http\Client\Response;
use function PHPUnit\Framework\isEmpty;


class AddDishController extends Controller
{
    public function __invoke(AddDishRequest $request, $dish_id, $order_id){

        $this->authorize('update',auth()->user());
        $validator = $request->validated();
        $order = Order::find($order_id);

        if ($order&& !$order['is_closed']){
            $dish = Dish::find($dish_id);
            if ($dish) {
                if($order->dishes()->firstWhere('dishes_id','=',$dish['id'])){
                    $count_old = $order->dishes()->firstWhere('dishes_id','=',$dish['id'])->pivot->count;
                    $order->dishes()->detach($dish);
                    $order->dishes()->attach($dish,['count'=>$count_old + $validator['count'],'created_at'=> now(),'updated_at'=> now()]);
                    $order->update([
                        'total_cost' => $order['total_cost'] + ($validator["count"]* $dish['cost']),
                        'count' => $order->count + $validator["count"],
                        'updated_at'=> now()
                    ]);
                    return response()->json([
                        'status' => 200,
                        'message' => "Блюдо успешно добавлено",
                        'data'=> $dish
                    ],200);
                }
                else{
                    $order->dishes()->attach($dish,['count'=> $validator['count']]);
                    $order->update([
                        'total_cost' =>  $order['total_cost'] + ($validator["count"] * $dish['cost']),
                        'count' => $order->count + $validator["count"],
                        'updated_at'=> now()
                    ]);
                    return response()->json([
                        'status' => 200,
                        'message' => "Блюдо успешно добавлено",
                        'data'=> $dish
                    ],200);

                }
            }else{
                return response()->json([
                    'status' => 501,
                    'message' => 'Нет блюда под таким номером'
                ],501);
            }

        }
        else{
            return response()->json([
                'status' => 502,
                'message' => 'Нет заказа под таким номером'
            ],502);
        }
    }



/*
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
    }*/

}
