<?php

namespace App\Http\Requests\Client\Project;

use App\Traits\CheckIfClientOwnedAProject;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
        $dt = new Carbon();

        return [
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:3|max:255',
            'category_ids' => 'required',
            'company_id' => 'required|exists:App\Models\Company,id',
            'cost' => 'required|numeric',
            'scope_of_work' => 'nullable|string|min:3',
            'due_date' => 'required|date|after:' . $dt->addDay()->format('Y-m-d'),
            'relevant_authorities' => 'nullable|string|min:3',
            'terms_and_conditions' => 'nullable|string|min:3',
        ];
    }
}
