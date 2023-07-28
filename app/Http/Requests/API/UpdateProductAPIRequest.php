<?php

namespace App\Http\Requests\API;

use App\Http\Requests\AppBaseFormRequest;
use App\Models\Product;


class UpdateProductAPIRequest extends AppBaseFormRequest
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
            'name' => 'required|min:1|max:200',
            'description' => 'required|min:1|max:1000',
            'qty' => 'min:0|max:5000',
            'qty_uom' => 'required|min:1|max:1000',
            'final_unit_price' => 'required|min:0|max:10000000',
            'unit_discount_pct' => 'required|min:0|max:100',
            'image_url'  => 'required|mimes:jpg,png,jpeg',
            'rating_score' => 'required|min:0|max:5',
            'final_total_rating' => 'required|min:0|max:500',
            'category_id' => 'required',
            'brand_id' => 'required'
            ];
        
    }
}
