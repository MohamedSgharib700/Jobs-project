<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'image'   =>'image|mimes:jpeg,png,jpg',
        ];

        if ( $this->has('code')) {
            $rules['code'] ='required|numeric|digits_between:2,5' ;
        }
        foreach (config()->get("app.locales") as $lang => $language) {
            $rules[$lang.".*"] ='required|alpha' ;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'code.required' => trans('code_is_required'),
            'code.numeric'  => trans('code_must_be_a_number'),
            'code.digits_between'=> trans('code_must_not_be_less_than_2_numbers_and_not_greater_than_5'),
           // 'code.max'      => trans('code_must_not_be_greater_than_5_numbers'),          
        ];
    }
}
