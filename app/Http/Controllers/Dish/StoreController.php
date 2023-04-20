<?php

namespace App\Http\Controllers\Dish;

use App\Http\Controllers\Dish\BaseController;
use App\Http\Requests\Dish\StoreRequest;

use App\Models\Dish;
use Illuminate\Support\Facades\Storage;


class StoreController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(StoreRequest $request){
        $this->authorize('create',Dish::class);
        $validator = $request->validated();
        $validator['image'] = Storage::put('/DishesImage',$validator['image']);
      //  $this->service->store($validator);
        $dish = Dish::create($validator);
        if ($dish){
            return response()->json([
                'status' => 200,
                'message' => "Блюдо успешно создано"
            ],200);
        }else{
            return response()->json([
                'status' => 501,
                'message' => 'Ошибка создания блюда'
            ],501);
        }
    }



}
