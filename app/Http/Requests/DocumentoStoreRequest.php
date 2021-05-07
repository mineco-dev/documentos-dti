<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentoStoreRequest extends FormRequest
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
            'fecha_emision' => 'nullable',
            'asunto' => 'required',
            'destinatario_id' => 'nullable',
            'respuesta' => 'nullable',
            'referencia' => 'nullable',
            'file_referencia' => 'nullable|mimes:pdf|max:10000',
            'tipo_documento_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'fecha_emision' => 'fecha de emisión',
            'destinatario_id' => 'destinatario',
            'file_referencia' => 'pdf de referencia',
            'tipo_documento_id' => 'tipo de documento'
        ];
    }
}
