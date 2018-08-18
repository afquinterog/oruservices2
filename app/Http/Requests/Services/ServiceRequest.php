<?php
namespace App\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'service_date' => 'required',
            'time' => 'required',
            'service_type_id' => 'required',
            'customer_id' => 'required',
            'branch_id' => 'required',
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
