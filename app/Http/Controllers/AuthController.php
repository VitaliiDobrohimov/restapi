<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Nette\Schema\ValidationException;
use Validator;

class AuthController extends Controller
{
        public function register(RegisterRequest $request){
            $validatedData = $request->validated();
            $data = $validatedData;
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);

        }
        public function login(LoginRequest $request){

            $validatedData = $request->validated();
            //Email
            $user = User::where('email',$validatedData['email'])->first();
            // Password
            if (!$user|| !Hash::check($validatedData['password'], $user->password))
            {
                return response([
                    'message'=>'Неправильный логин или пароль'
                ],401);
            }
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
       /*     if (!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'status'=> 401,
                'message'=> 'Неверные данные для входа'
            ],401);
        }
        $user =User::where('email',$request['email'])->firstOrFail();*/

        }

public function logout(){
    auth()->user()->tokens()->delete();
    return response([
        'message' => 'Авторизация завершена'
    ],401);
}

    public function forgotPassword(Request $request){

            $request->validate([
                'email'=> 'required|email'
           ]);
            $status = Password::sendResetLink(
                $request->only('email')
            );
            if ($status != Password::RESET_LINK_SENT){
                throw ValidationException::withMessages([
                   'email'=>$status
                ]);
            }
            return response(['status'=> $status]);


}


}
