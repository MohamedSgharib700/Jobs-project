<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SeekerExperiencesRequest extends FormRequest
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
        $rules = [
            'years_of_experience'  => 'required',
          
        ];

        if($this->filled('previous_experience')) {
            $rules  ['previous_experience']  = 'regex:/^[\pL\s\-]+$/u' ;
        }

        return  $rules;
    }

    public function messages()
    {
        return [
            'previous_experience.regex' => trans('previous_experience_should_only_be_letters'),
        ];
    }

}
