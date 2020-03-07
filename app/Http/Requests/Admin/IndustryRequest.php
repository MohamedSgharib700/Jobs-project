<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class IndustryRequest extends FormRequest
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
        $rules = [];

        foreach (config()->get("app.locales") as $lang => $language) {
            $rules[$lang.".*"] = "required|regex:/^[\p{L} ]+$/u" ;
        }
        if ($this->isMethod('post')) {
            $rules["image"] = "required" ;
        }

        return $rules ;
    }

    public function messages()
    {
        $messages = [];

        $messages["image.required"] = trans('image_required');

        foreach (config()->get("app.locales") as $lang => $language) {
            $messages[$lang.".*.required"] = trans('name_'.$lang.'_required');
          
        }

        return $messages;
    }
}
