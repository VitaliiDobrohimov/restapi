<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Filters\UserFilter;
use App\Http\Requests\User\IndexRequest;
use App\Models\categories;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class EditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke($id){
        $this->authorize('view',auth()->user());
        $category = Category::find($id);
        if ($category){
            return response()->json([
                'status' => 200,
                'user' => $category,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Нет категории под таким номером'
            ],404);
        }
    }


}
