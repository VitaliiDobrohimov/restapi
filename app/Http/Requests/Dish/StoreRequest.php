<?php

namespace App\Http\Requests\Dish;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
                'image'=>'required|file',
                'composition' =>'required|max:250',
                'calories' => 'required|numeric',
                'cost' => 'required|numeric',
                'category_id' => 'required|numeric',
        ];
    }
}

