<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\User\PasswordMail;
use App\Models\Report;
use App\Models\ResetPassword;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


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
                        'role_id'=> $user->role->name,
                        'access_token' => $token,
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
                        'role_id'=> $user->role->name,
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
                   'message' => 'ВИТАЛЯ УСТАЛъ'
             ],200);
}
    public function forgot_Password(Request $request){

        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);


    }
    public function forgotPassword(Request $request){

            $request->validate([
                'email'=> 'required|email'
           ]);
        $resPassword = ResetPassword::create([
                'email'=>$request->email,
                'pin_code'=>rand(100000,999999),
                'expires_at'=>Carbon::tomorrow()
            ]
        );
        $resPassword->save();
        $password = $resPassword->pin_code;
        Mail::to($request['email'])->send(new PasswordMail($password));

        return ;


}
    public function resetPassword(Request $request){
        $request->validate([
            'pin_code' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('/login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }


}
