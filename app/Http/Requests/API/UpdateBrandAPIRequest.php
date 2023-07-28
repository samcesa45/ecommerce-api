<?php

namespace App\Http\Requests\API;

use App\Http\Requests\AppBaseFormRequest;
use App\Models\Brand;

class UpdateBrandAPIRequest extends AppBaseFormRequest
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
            'name' => 'required|min:3|max:100'
        ];
    }
}
