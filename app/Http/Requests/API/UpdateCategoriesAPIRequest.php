<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\AppBaseFormRequest;
use App\Models\Category;

class UpdateCategoriesAPIRequest extends AppBaseFormRequest
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
            'name'=>'required|min:1|max:1000',
            'parent_id' => 'nullable|exists:categories,id'
        ];
    }
}
