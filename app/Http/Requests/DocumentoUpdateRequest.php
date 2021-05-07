<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentoUpdateRequest extends FormRequest
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
            'fecha_emision' => 'required',
            'asunto' => 'required',
            'destinatario_id' => 'required',
            'respuesta' => 'required',
            'file' => 'nullable|mimes:pdf|max:10000',
            'referencia' => 'nullable',
            'file_referencia' => 'nullable|mimes:pdf|max:10000',
        ];
    }

    public function attributes()
    {
        return [
            'fecha_emision' => 'fecha de emisión',
            'destinatario_id' => 'destinatario',
            'file' => 'pdf del documento',
            'file_referencia' => 'pdf de referencia'
        ];
    }
}
