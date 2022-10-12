<?php

namespace App\Http\Requests\Client\Proposal;

use Illuminate\Foundation\Http\FormRequest;

class SubmitProposalRequest extends FormRequest
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
            'rate' => 'required|numeric',
            'cover_letter' => 'required|string|min:20',
            'attachments.*' => 'mimes:pdf,docx,docs,png,jpg,jpeg|max:2048',
        ];
    }
}
