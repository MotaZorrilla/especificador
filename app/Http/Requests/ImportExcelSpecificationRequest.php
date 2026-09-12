<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportExcelSpecificationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'filedata' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:25600', // 25 MB max
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'filedata.required' => 'Debes seleccionar un archivo de hoja de cálculo para importar.',
            'filedata.file' => 'El elemento cargado debe ser un archivo válido.',
            'filedata.mimes' => 'Formato no compatible. El archivo debe ser una planilla Excel (.xlsx, .xls) o archivo delimitado (.csv).',
            'filedata.max' => 'El archivo supera el tamaño máximo permitido de 25 MB.',
        ];
    }
}
