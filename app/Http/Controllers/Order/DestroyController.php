<?php

namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;


class DestroyController extends Controller
{
    public function __invoke($id){
        $this->authorize('delete',auth()->user());
        $user = User::find($id);
        if ($user){
            $user->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Пользователь под номером ' . $id . 'удален',
                'user' => $user
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Ошибка нет такого пользователя'
            ],404);
        }
    }
}
