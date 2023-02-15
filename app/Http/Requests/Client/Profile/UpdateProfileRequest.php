<?php

namespace App\Http\Requests\Client\Profile;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        $dt = new Carbon();
        

        return [
            'name' => 'required|string|min:3',            
            'gender' => 'nullable|string',
            'address' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'email' => 'required|email',
            'contact_number' => 'nullable|string|min:11',
            'tag_line' => 'nullable|string|min:2|max:100',
            'profile_pic' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
            'birth_date' => 'required|date|before:' . $dt->subYears(13)->format('Y-m-d')
        ];
    }
}
