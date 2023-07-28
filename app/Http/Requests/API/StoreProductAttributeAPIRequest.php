<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\AppBaseFormRequest;
use App\Models\ProductAttribute;

class StoreProductAttributeAPIRequest extends AppBaseFormRequest
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
            'attribute' => 'required|min:5|max:200',
            'value' => 'required|min:3|max:200',
            'product_id' => 'required'
        ];
    }
}
