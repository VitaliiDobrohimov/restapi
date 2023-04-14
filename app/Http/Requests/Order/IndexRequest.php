<?php

namespace App\Http\Requests\Order;

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
            'orderBy'=>[Rule::in(['number', 'total_cost','date_closed','waiter_id'])],
            'number'=> 'numeric',
            'date_closed'=>'date',
            'total_cost'=>'string'
        ];
    }
}
