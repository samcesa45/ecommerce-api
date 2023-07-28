<?php

namespace App\Http\Requests\API;

use App\Models\Order;
use App\Http\Requests\AppBaseFormRequest;

class UpdateOrderAPIRequest extends AppBaseFormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'final_total_price' => 'required|min:0|Max:10000000',
            'total_discount_pct' => 'required|min:0|max:100',
            'status' => 'required|min:5|max:100'
        ];
    }
}
