<?php

namespace App\Http\Requests\Dish;

use Illuminate\Foundation\Http\FormRequest;

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
            'image'=>'file',
            'composition' =>'max:250',
            'calories' => 'numeric',
            'cost' => 'numeric',
            'category_id' => 'numeric',
        ];
    }
}

