<?php

namespace App\Http\Controllers\Category;

use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


class StoreController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(StoreRequest $request){
        $this->authorize('create',auth()->user());
        $validator = $request->validated();
        $validator['image'] = Storage::put('/CategoryImage',$validator['image']);
        //$this->service->store($validator['image']);
        $category = Category::create($validator);
        if ($category){
            return response()->json([
                'status' => 200,
                'message' => "Категория успешно создана"
            ],200);
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Ошибка создания категории'
            ],500);
        }
    }



}
