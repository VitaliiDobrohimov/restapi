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
        $this->authorize('view',auth()->user());
        $validator = $request->validated();
        $dish = Dish::find($id);
        if ($dish)
        {
            $this->service->update($validator,$dish);
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
