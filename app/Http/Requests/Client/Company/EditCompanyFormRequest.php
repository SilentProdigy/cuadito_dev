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
        return $this->company->checkIfUserOwned();
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
            'address' => 'string|required|max:100',
            'email' => 'email:rfc,dns|required',
            'contact_number' => 'string|required|min:11|max:11'
        ];
    }
}
