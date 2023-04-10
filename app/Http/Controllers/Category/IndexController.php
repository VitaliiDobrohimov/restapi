<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Filters\CategoryFilter;
use App\Http\Requests\User\IndexRequest;
use App\Models\categories;
use App\Models\Category;
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
        $filter = app()->make(CategoryFilter::class,['queryParams'=>array_filter($data)]);
        $data = Category::filter($filter);
        if (isset($request['orderBy'])&&isset($request['sort'])){
            return $filter->orderBy($request['orderBy'],$request['sort'])->get();
        }
        return Category::filter($filter)->get();


    }


}
