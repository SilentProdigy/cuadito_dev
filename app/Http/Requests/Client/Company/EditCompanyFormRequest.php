<?php

namespace App\Http\Requests\Client\Company;

use Illuminate\Foundation\Http\FormRequest;

class EditCompanyFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'string|required|min:3',
            'address' => 'string|required',
            'email' => 'string|required',
            'contact_number' => 'string|required'
        ];
    }
}
