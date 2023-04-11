<?php

namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\IndexRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Filters\UserFilter;
use App\Models\Traits;
use App\Models\CollectionList as ModelsCollectionList;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->authorize('view',auth()->user());
        $data = $request->validated();
        $filter = app()->make(OrderFilter::class,['queryParams'=>array_filter($data)]);
        $data = Order::filter($filter);
        if (isset($data['orderBy'])&&isset($data['sort'])){
            return $data->orderBy($request['orderBy'],$request['sort'])->get();
        }
            return Order::filter($filter)->get() ;


        /*if ($request['orderBy'] == 'name')
        {
            if ($request['sort'] == 'desc'){
                return $data->orderBy('id','desc')->get();
            }
            elseif ($request['sort'] == 'asc'){
                return $data->orderBy('id','asc')->get();
            }

        }elseif ($request['orderBy'] == 'name'){

        }*/

        //User::filter($filter)->paginate(10);

//        dd($users);
        //$users = User::paginate(10);
/*
        if ($users->count() >0 ){
            return response()->json([
                'status'=> 200,
                'name' =>$users
            ],200);
        }
        else {
            return response()->json([
                'status'=> 404,
                'message' =>'Ошибка'
            ],404);

        }*/
    }
}
