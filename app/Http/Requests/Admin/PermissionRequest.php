<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        
        foreach (config()->get("app.locales") as $key => $lang) {
            $rules[$key . ".*"] = "required|regex:/^[\pL\s\-]+$/u";
        }

        return $rules;
    }

}
