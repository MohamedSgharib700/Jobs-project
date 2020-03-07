<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AgencyRequest extends FormRequest
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
            'name'        =>'required|regex:/^[\pL\s\-]+$/u',
            'email'       =>'required|email',
            'phone' => 'required|numeric|digits_between:5,20',
            'location_id' =>'required',
            'long'     =>'required',
            'lat'     =>'required',
            'address'     =>'required',
        ];

       
        return $rules;
    }
    public function messages()
    {
        return [
            'phone.required' => trans('phone_number_required'),
            'phone.numeric' => trans('phone_number_must_be_numpers'),
            'phone.digits_between' => trans('phone_number_must_be_between_5_and_20'),
            'long.required' => trans('please_drag_the_marker_on_the_map'),
            'lat.required' => trans('please_drag_the_marker_on_the_map'),
            'address.required' => trans('please_drag_the_marker_on_the_map'),
            
        ];
    }
}
