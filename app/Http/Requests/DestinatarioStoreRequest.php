<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinatarioStoreRequest extends FormRequest
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
            'saludo_id' => 'nullable',
            'name' => 'required|unique:dependencias,name,dependencia_id',
            'dependencia_id' => 'required',
            'entidad_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'saludo_id' => 'saludo',
            'name' => 'nombre del destinatario',
            'dependencia_id' => 'dependencia',
            'entidad_id' => 'entidad'
        ];
    }
}
