<?php

namespace App\Http\Requests\UsersModule;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function rules(Request $request)
    { 
        if( $request->get('id') ){
            return [
                'company_id' => 'required',
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($request->get('id')),
                    ],
                ];    
        }
        else{
            return [
                'email' => 'required|unique:users',
                'password' => 'required',
                'password2' => 'required|same:password',
                'company_id' => 'required'
            ];       
        }
        
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'       => 'El campo email es requerido',
            'email.unique'         => 'El campo email ya existe en la base de datos',
            'password2.same'       => 'El password debe coincidir',
            'company_id.required'  => 'El usuario debe estar asociado a una compañia',

        ];
    }
}
