<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class JobDataRequest extends FormRequest
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
            'job_title'    => 'required|regex:/^[a-zA-Z ]+$/|min:3',
            'industry_id'   => 'required',
            'roles'        => 'required',
            'skills'         => 'required',
            'social_account'  => 'sometimes|nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ];

        return  $rules;
    }

    public function messages()
    {
        return [
            'job_title.min' => trans('job_title_min'),
            'industry_id.required'  => trans('industry_id_required'),
            'roles.required'      => trans('roles_required'),
            'skills.required' => trans('please_enter_skills'),
        ];
    }
}
