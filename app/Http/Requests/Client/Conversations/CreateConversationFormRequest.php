<?php

namespace App\Http\Requests\Client\Conversations;

use Illuminate\Foundation\Http\FormRequest;

class CreateConversationFormRequest extends FormRequest
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
            'subject' => 'required|min:3|string|min:3|max:80',
            'email' => 'required|email:rfc,dns',
            'content' => 'required|string|min:3|max:255'
        ];
    }
}
