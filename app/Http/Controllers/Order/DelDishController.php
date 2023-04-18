<?php

namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;
use App\Http\Requests\Order\DelDishRequest;
use App\Models\Dish;
use App\Models\Order;

class DelDishController extends Controller
{
    public function __invoke(DelDishRequest $request, $dish_id,$order_id,$count)
    {
        $this->authorize('update', auth()->user());
       // $validator = $request->validated();
        $order = Order::find($order_id);
        if ($order && !$order['is_closed']) {
            $dish = Dish::find($dish_id);
            if ($dish) {
                if ($order->dishes()->firstWhere('dishes_id', '=', $dish['id'])) {
                    $count_old = $order->dishes()->firstWhere('dishes_id', '=', $dish['id'])->pivot->count;
                    if($count_old <$count)
                        return response()->json([
                            'status' => 504,
                            'message' => "Введено неверное количсество блюд",
                        ], 504);


                    $order->dishes()->detach($dish);

                    if ($count_old != $count)
                        $order->dishes()->attach($dish,['count'=>$count_old - $count,
                            'updated_at'=> now(),
                            'created_at'=> now()]);
                    $order->update([
                        'total_cost' => $order['total_cost'] - ($count * $dish['cost']),
                        'count' => $order->count - $count,
                        'updated_at'=> now()
                    ]);


                    return response()->json([
                        'status' => 200,
                        'message' => "Блюдо успешно удалено из заказа",
                        'data' => $dish
                    ], 200);
                } else {

                    return response()->json([
                        'status' => 502,
                        'message' => "Блюдо не найдено в заказе",
                    ], 502);

                }
            } else {

                return response()->json([
                    'status' => 501,
                    'message' => 'Нет блюда под таким номером'
                ], 501);
            }

        } else {

            return response()->json([
                'status' => 503,
                'message' => 'Нет заказа под таким номером'
            ], 503);
        }
    }
}

