<?php

namespace App\Http\Requests\Client\Conversations;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLabelFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->label->isOwned();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:10',
        ];
    }
}
