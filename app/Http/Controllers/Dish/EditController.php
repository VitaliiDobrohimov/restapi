<?php

namespace App\Http\Controllers\Dish;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Filters\UserFilter;
use App\Http\Requests\User\IndexRequest;
use App\Models\categories;
use App\Models\Category;
use App\Models\Dish;
use App\Models\User;
use Illuminate\Http\Request;

class EditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke($id){
        $this->authorize('view',auth()->user());
        $data = Dish::find($id);
        if ($data  ){
            return response()->json([
                'status' => 200,
                'user' => $data,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Нет блюда под таким номером'
            ],404);
        }
    }


}
