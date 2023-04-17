<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class IndexRequest extends FormRequest
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
            'orderBy'=>[Rule::in(['name', 'email','role_id'])],
            'sort'=>[Rule::in(['asc', 'desc'])],
            'email'=> 'email',
            'role_id'=>'numeric'
        ];
    }
}
