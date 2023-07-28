<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\AppBaseFormRequest;
use App\Models\Customer;
class UpdateCustomerAPIRequest extends AppBaseFormRequest
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
            'email'=> 'required|email',
            'first_name' => 'required|min:3|max:100',
            'last_name' => 'required|min:3|max:100',
            'telephone' => 'required',
            'profile_image_url'  => 'required',
            'address' => 'required'
        ];
    }
}
