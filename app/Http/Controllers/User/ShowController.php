<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;


use App\Models\User;


class ShowController extends Controller
{
    public function __invoke($id){
        $this->authorize('view',auth()->user());
        $user = User::find($id);
        if ($user){
            return response()->json([
                'status' => 200,
                'user' => $user,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Нет пользователя под таким номером'
            ],404);
        }
    }



}
