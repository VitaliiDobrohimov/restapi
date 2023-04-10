<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
                'name' =>'required|string|max:191',
                'email'=>'required|email|max:191|unique:users',
                'password'=>'required|max:25',
                'pin_code'=>'required|digits:4|max:4',
                'role_id'=>Rule::in([1,2,3]),'|min:1|max:3'
        ];
    }
}

