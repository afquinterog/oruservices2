<?php

namespace App\Http\Requests\ServiceTypes;

use Illuminate\Foundation\Http\FormRequest;

class BasicRequest extends FormRequest
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
        return [
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'code.required' => 'El campo codigo es requerido',
            'name.required'  => 'El campo nombre es requerido',
            'description.required'  => 'El campo descripción es requerido',

        ];
    }
}
