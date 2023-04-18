<?php

namespace App\Http\Requests\Reports;

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

            'orderBy'=>[Rule::in(['total_cost', 'total_orders','created_at'])],
            'sort'=>[Rule::in(['asc', 'desc'])],
            'total_cost'=>'numeric',
            'total_orders'=>'numeric',
            'created_at'=>'date',

        ];
    }
}
