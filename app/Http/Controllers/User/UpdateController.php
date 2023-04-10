<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;

use App\Http\Requests\User\UpdateRequest;
use App\Models\User;


class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, int $id){
        $validator = $request->validated();
        $user = User::find($id);
        if ($user)
        {
            $user->update($validator);

            return response()->json([
                'status' => 200,
                'message' => "Пользователь успешно обновлен"
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Ошибка обновления пользователя'
            ],404);
        }

    }



}
