<?php

namespace App\Http\Requests\Client\Company;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequirementRequest extends FormRequest
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
            'requirement' => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
            'requirement_id' => 'required|exists:App\Models\Requirement,id'
        ];
    }

    public function messages()
    {
        return [
            // 'required' => ': file is required.',
            'requirement.max' => 'Ooops! File is to large to upload, max file size is 2MB.',
        ];
    }
}
