<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Filters\UserFilter;
use App\Http\Requests\User\IndexRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\categories;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke (UpdateRequest $request, int $id){
        $this->authorize('view',auth()->user());
        $validator = $request->validated();
        $category = Category::find($id);
        if ($category)
        {
            $this->service->update($validator,$category);
            $validator['image'] = Storage::put('/CategoryImage',$validator['image']);
            $category->update($validator);

            return response()->json([
                'status' => 200,
                'message' => "Категория успешно обновлена"
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Ошибка обновления категории'
            ],404);
        }

    }


}
