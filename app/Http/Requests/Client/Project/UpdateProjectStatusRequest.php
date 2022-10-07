<?php

namespace App\Http\Requests\Client\Project;

use App\Models\Project;
use App\Traits\CheckIfClientOwnedAProject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectStatusRequest extends FormRequest
{
    use CheckIfClientOwnedAProject;

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
            'status' =>  [
                'required',
                Rule::in(Project::PROJECT_STATES)
            ],
        ];
    }
}
