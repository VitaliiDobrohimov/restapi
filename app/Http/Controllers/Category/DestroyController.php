<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


class DestroyController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke($id){
        $this->authorize('delete',auth()->user());
        $category = Category::find($id);
        $this->service->destroy($category);
        if ($category){
            $category->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Категория под номером ' . $id . ' удалена',
                'user' => $category
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Ошибка нет такой категории'
            ],404);
        }

    }


}
