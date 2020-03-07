<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class PersonalDataRequest extends FormRequest
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
            'first_name'    => 'required|regex:/^[a-zA-Z ]+$/|min:2',
            'last_name'     => 'required|regex:/^[a-zA-Z ]+$/|min:2',
            'country_key'   => 'required',
            'phone'         => 'required|numeric|digits_between:5,20',
            'email'         => 'required|email|min:2|max:100|unique:users,email,'.auth()->user()->id,
            'nationality_id'   => 'required',
            'residence_city'   => 'required',
        ];

        return  $rules;
    }

    public function messages()
    {
        return [
            'phone.required' => trans('phone_number_required'),
            'phone.numeric'  => trans('phone_must_be_a_number'),
            'phone.digits_between'      => trans('phone_must_not_be_less_than_5_numbers_and_not_greater_than_20'),
            'nationality_id.required' => trans('please_select_nationality'),
            'country_key.required' => trans('please_select_residence_country'),
            'residence_city.required' => trans('please_select_residence_city'),
            'first_name.min' => trans('first_name_min_validation'),
            'last_name.min' => trans('last_name_min_validation'),

        ];
    }
}
