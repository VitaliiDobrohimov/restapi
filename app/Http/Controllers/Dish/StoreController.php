<?php

namespace App\Http\Controllers\Dish;

use App\Http\Controllers\Dish\BaseController;
use App\Http\Requests\Dish\StoreRequest;

use App\Models\Dish;


class StoreController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(StoreRequest $request){
        $this->authorize('create',auth()->user());
        $validator = $request->validated();
        $this->service->store($validator);
        $dish = Dish::create($validator);
        if ($dish){
            return response()->json([
                'status' => 200,
                'message' => "Блюдо успешно создано"
            ],200);
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Ошибка создания блюда'
            ],500);
        }
    }



}
