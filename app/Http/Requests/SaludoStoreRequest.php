<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaludoStoreRequest extends FormRequest
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
            'name' => 'required|unique:saludos,name'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre del saludo'
        ];
    }
}
