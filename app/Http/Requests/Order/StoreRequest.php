<?php

namespace App\Http\Requests\Order;

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
                'number' =>'required|string|max:191',
                'count'=>'required|numeric',
                'total_cost' => 'required|numeric',
                'date_closed' => 'date',
                'waiter_id'=>'required|numeric'
        ];
    }
}

