<?php

namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;

use App\Http\Requests\Order\UpdateRequest;
use App\Models\User;


class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, int $id){
        $this->authorize('view',auth()->user());
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
