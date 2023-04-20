<?php

namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;
use App\Http\Requests\Order\IndexRequest;
use App\Models\Order;
use App\Http\Controllers\Filters\OrderFilter;
use App\Models\Report;
use App\Models\User;


class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $this->authorize('view',Order::class);
        $data = $request->validated();

        $filter = app()->make(OrderFilter::class,['queryParams'=>array_filter($data)]);
        $data = Order::filter($filter);
        if (isset($request['orderBy'])&&isset($request['sort'])){

            return $data->orderBy($request['orderBy'],$request['sort'])->get();
        }
        if (isset($request['name'])){

          $data->where("waiter_id",'=',
                User::where('name',
                    'like',
                 "%{$request['name']}%")->first()->id)->get();
        }
        elseif (isset($request['number'])){
           $data->where('number','like',"%{$request['number']}%")->get();
        }
        if (isset($request['total_cost'])){

            $data->where('total_cost','like',"%{$request['total_cost']}%")->get();
        }
        elseif (isset($request['date_closed'])){
            $data->where('date_closed','like',"%{$request['date_closed']}%")->get();
        }
        return $data->paginate(10);

    }
}

