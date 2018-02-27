<?php

namespace App\Http\Requests\Customers;

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
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'category_id' => 'required',
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
            'code.required' => 'El campo identificación es requerido.',
            'firstname.required' => 'El campo nombres es requerido.',
            'lastname.required' => 'El campo apellidos es requerido.',
            'email.required' => 'El campo correo es requerido.',
            'address.required' => 'El campo dirección es requerido.',
            'phone.required' => 'El campo teléfono es requerido.',
            'category_id.required' => 'El campo categoría es requerido.',
        ];
    }
}
