<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'title'                     =>'required|regex:/^[\pL\s\-]+$/u',
            'years_of_experience'       =>'required',
            'career_level'              =>'required',
            'country_id'                =>'required',
            'industry_id'               =>'required',

        ];


        return $rules ;
    }

}
