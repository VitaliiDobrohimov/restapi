<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;


class StoreController extends Controller
{
    public function __invoke(UserRequest $request){
        $this->authorize('create',auth()->user());
        $validator = $request->validated();
        $user = User::create($validator);
        if ($user){
            return response()->json([
                'status' => 200,
                'message' => "Пользователь успешно создан"
            ],200);
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Ошибка создания пользователя'
            ],500);
        }
    }



}
