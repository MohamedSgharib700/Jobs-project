<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'select_file' => 'required|mimes:xls,ods,odp,odt',
        ] ;
    }

    public function messages()
    {
        return [
            'select_file.required' => trans('file_is_required'),
        ] ;
    }
}
