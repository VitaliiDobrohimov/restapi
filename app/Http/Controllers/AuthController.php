<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
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

            if (isset($validatedData['email'])&&isset($validatedData['password'])){
                $user = User::where('email',$validatedData['email'])->first();
                // Password
                if ($user&& Hash::check($validatedData['password'], $user->password))
                {
                    $token = $user->createToken('auth_token')->plainTextToken;
                    return response()->json([
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                    ]);
                }
                else{
                    return response([
                        'message'=>'Неправильный логин или пароль'
                    ],401);
                }
            }
            //pincode
            elseif (isset($validatedData['pin_code'])){
                $user = User::where('pin_code',$validatedData['pin_code'])->first();
                if (User::where('pin_code',$validatedData['pin_code'])->first()){
                    $token = $user->createToken('auth_token')->plainTextToken;
                    return response()->json([
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                    ]);
                }
                else{
                    return response([
                        'message'=>'Неправильный Пинкод'
                    ],402);
                }

            }

        }

        public function logout(){
             auth()->user()->tokens()->delete();
            return response([
                   'message' => 'Авторизация завершена'
             ],200);
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
