<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserRequest;
use App\Models\User;


class UserController extends Controller
{
    protected function index()
    {
        $users = User::all();
        if ($users->count() >0 ){
            return response()->json([
                'status'=> 200,
                'name' =>$users
            ],200);
        }
        else {
            return response()->json([
                'status'=> 404,
                'message' =>'Ошибка'
            ],404);

        }



    }
    public function store(UserRequest $request){

        $validator = $request->validated();
            $user = User::create([
                'name' =>$request->name,
                'email' =>$request->email,
                'password' =>$request->password,
                'pin_code' =>$request->pin_code,
                'role_id' =>$request->role_id,
            ]);

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
    public function show($id){

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
                'message' => 'Нет студента под таким номером'
            ],404);
        }
    }
    public function edit($id){
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
                'message' => 'Нет студента под таким номером'
            ],404);
        }
    }

    public function update(UserRequest $request, int $id){
        $validator = $request->validated();
            $user = User::find($id);
            if ($user){
                $user->update([
                    'name' =>$request->name,
                    'email' =>$request->email,
                    'password' =>$request->password,
                    'pin_code' =>$request->pin_code,
                    'role_id' =>$request->role_id,
                ]);
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
    public function destroy($id){

        $user = User::find($id);
        if ($user){
            $user->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Пользователь под номером ' . $id
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
