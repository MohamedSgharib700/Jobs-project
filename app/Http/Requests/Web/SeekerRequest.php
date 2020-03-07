<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class SeekerRequest extends FormRequest
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

//        $passwordRules = 'required|min:8|max:100';

        if ($this->has('email')) {

            $rules = [
                'email'       => 'required|email|min:2|max:100|unique:users',

            ];
        }

        if ($this->has('password')){
            $rules = [
                'old_password' => 'required',
                'password' => 'required',
            ];
        }


        return  $rules;
    }


}
