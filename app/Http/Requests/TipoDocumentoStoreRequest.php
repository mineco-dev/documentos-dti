<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoDocumentoStoreRequest extends FormRequest
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
            'name' => 'required|unique:tipo_documentos,name',
            'prefix' => 'required',
            'correlativo' => 'required',
            'anio' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'prefix' => 'prefijo',
            'anio' => 'año'
        ];
    }
}
