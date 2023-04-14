<?php

namespace App\Http\Controllers\Dish;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Filters\CategoryFilter;
use App\Http\Controllers\Filters\DishesFilter;
use App\Http\Requests\Dish\IndexRequest;
use App\Models\categories;
use App\Models\Category;
use App\Models\Dish;
use App\Models\User;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke( IndexRequest $request)
    {
        $this->authorize('view',auth()->user());
        $data = $request->validated();
        $filter = app()->make(DishesFilter::class,['queryParams'=>array_filter($data)]);
        $data = Dish::filter($filter);
        if (isset($request['orderBy'])&&isset($request['sort'])){
            return $data->orderBy($request['orderBy'],$request['sort'])->get();
        }
        elseif (isset($request['name'])){
            $data->where('name','like',"%{$request['name']}%")->get();
        }
        elseif (isset($request['composition'])){
            $data->where('composition','like',"%{$request['composition']}%")->get();
        }
        elseif (isset($request['calories'])){
            $data->where('calories','like',"%{$request['calories']}%")->get();
        }
        elseif (isset($request['cost'])){
            $data->where('calories','like',"%{$request['calories']}%")->get();
        }
        return $data->paginate(10);


    }


}
