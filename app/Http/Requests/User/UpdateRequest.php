<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
                'name' =>'string|max:191',
                'email'=>'email|max:191|unique:users',
                'password'=>'string',
                'pin_code'=>'digits:4|max:4',
                'role_id'=>Rule::in([1,2,3]),'|min:1|max:3'
        ];
    }
}

