<?php

namespace App\Http\Controllers\Dish;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Filters\CategoryFilter;
use App\Http\Controllers\Filters\DishesFilter;
use App\Http\Requests\User\IndexRequest;
use App\Models\categories;
use App\Models\Category;
use App\Models\Dish;
use App\Models\User;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(IndexRequest $request)
    {
        $this->authorize('view',auth()->user());
        $data = $request->validated();
        $filter = app()->make(DishesFilter::class,['queryParams'=>array_filter($data)]);
        $data = Dish::filter($filter);
        if (isset($request['orderBy'])&&isset($request['sort'])){
            return $data->orderBy($request['orderBy'],$request['sort'])->get();
        }
    /*
        if (isset($request['cost'])&&isset($request['sort']))
        {
            return $data->orderBy($request['cost']);
        }
        if (isset($request['calories'])&&isset($request['sort']))
        {
            return $data->orderBy($request['calories'],$request['sort']);
        }*/
        return Dish::filter($filter)->get();


    }


}
