<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\OrderItem;
use App\Http\Requests\AppBaseFormRequest;

class StoreOrderItemAPIRequest extends AppBaseFormRequest
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
            'order_id' => 'required',
            'product_id' => 'required',
            'qty' => 'min:0|max:5000',
            'qty_uom' => 'required|min:1|max:1000',
            'final_unit_price'=>'required|min:0|max:10000000',
            'unit_discount_pct'=>'required|min:0|max:100',
            'status' => 'required|min:1|max:100'
        ];
    }
}
