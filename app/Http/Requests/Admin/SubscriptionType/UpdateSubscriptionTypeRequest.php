<?php

namespace App\Http\Requests\Admin\SubscriptionType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriptionTypeRequest extends FormRequest
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
            'name' => ['required','string','min:3'],
            'amount' => ['required', 'numeric', 'min:1000'],
            'max_projects_count' => ['numeric','min:1'],
            // 'max_proposals_count' => ['numeric','min:1'],
            'description' => ['nullable', 'string', 'min:10']
        ];
    }
}
