<?php

namespace App\Http\Controllers\Dish;

use App\Http\Controllers\Dish\BaseController;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Support\Facades\Storage;


class DestroyController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke($id){

        $this->authorize('delete',auth()->user());
        $data = Dish::find($id);
        if ($data){
            $this->service->destroy($data);
            $data->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Блюдо  под номером ' . $id . ' удалено',
                'user' => $data
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Ошибка нет такой блюда'
            ],404);
        }

    }
}
