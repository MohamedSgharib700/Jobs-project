<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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


    public function rules()
    {
        $rules = [
            'first_name'        =>'required|regex:/^[\pL\s\-]+$/u',
            'last_name'        =>'required|regex:/^[\pL\s\-]+$/u',
            // 'country_key' => 'required|numeric|digits_between:5,20',
            'phone' => 'required|numeric|digits_between:5,20',
            'email'       =>'required|email|unique:users',
            'password' => 'required|confirmed|min:8|max:40',
        ];

       
        return $rules;
    }
    public function messages()
    {
        return [
            'phone.required' => trans('phone_number_required'),
            'phone.numeric' => trans('phone_number_must_be_numpers'),
            'phone.digits_between' => trans('phone_number_must_be_between_5_and_20'),
            'address.required' => trans('please_drag_the_marker_on_the_map'),
            'email.unique' => trans('email_is_already_taken'),

        ];
    }
}
