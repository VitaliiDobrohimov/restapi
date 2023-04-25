<?php

namespace App\Http\Controllers\Dish;


use App\Http\Controllers\Dish\BaseController;
use App\Http\Requests\Dish\UpdateRequest;
use App\Models\Dish;
use Illuminate\Support\Facades\Storage;

class UpdateController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke (UpdateRequest $request, int $id){
        $this->authorize('update',Dish::class);
        $validator = $request->validated();
        $dish = Dish::findOrFail($id);
        if ($dish)
        {
            if(isset($validator['image'])){
                $validator['image'] = Storage::put('/public/DishesImage',$validator['image']);
                $validator['url'] = 'http://laravel-rest.ru/' . Storage::url($validator['image']);
                $this->service->update($validator,$dish);
            }
            $dish->update($validator);

            return response()->json([
                'status' => 200,
                'message' => "Блюдо успешно обновлено"
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Ошибка обновления блюда'
            ],404);
        }

    }


}
