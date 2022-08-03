<?php

namespace App\Http\Requests\Client\Project;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'category_ids' => 'required',
            'company_id' => 'required',
            'cost' => 'required|numeric',
            'scope_of_work' => 'nullable|string|min:3',
            'due_date' => 'required|date',
            'relevant_authorities' => 'nullable|string|min:3',
            'terms_and_conditions' => 'nullable|string|min:3',
        ];
    }
}
