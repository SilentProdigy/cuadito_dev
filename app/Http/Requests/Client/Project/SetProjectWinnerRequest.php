<?php

namespace App\Http\Requests\Client\Project;

use Illuminate\Foundation\Http\FormRequest;

class SetProjectWinnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->checkIfClientOwnedAProject($this->project);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'remarks' => 'nullable|string|min:3|max:255',
            'winner_bidding_id' => 'required'
        ];
    }
}
