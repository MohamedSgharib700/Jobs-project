<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $passwordRules = 'min:8|max:100';
        $rules = [
            'phone' => 'required|numeric|digits_between:5,20',
            'first_name'  => 'required|regex:/^[\p{L} ]+$/u|max:50|min:2',
            'last_name'  => 'required|regex:/^[\p{L} ]+$/u|max:50|min:2',
            'type'  => 'required',
            'email' => 'required|email|min:2|max:100|unique:users'
        ];

        if ($this->method() == 'POST') {
            $rules['password'] = $passwordRules ."|required";

        }

        if ($this->method() == 'PUT') {
            $rules['email'] = $rules['email'] . ",email," . $this->id;
            if ($this->password) {
                $rules['password'] = $passwordRules;
            }
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'phone.numeric'  => trans('phone_must_be_a_number'),
            'phone.digits_between'      => trans('phone_must_not_be_less_than_5_numbers_and_not_greater_than_20'),
       
            'password.min' => trans('password_should_be_at_least_8_numpers_or_letters'),
            'password.required' => trans('password_required'),
        ];
    }
}

