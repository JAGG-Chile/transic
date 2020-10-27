<?php

namespace qbrema\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaFormRequest extends FormRequest
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
            'nombre'=>'required|max:100',
            'direccion'=>'required|max:100',
            'telefono'=>'required|max:20',
            'email'=>'required|max:50',
            'rut'=>'required|max:10',
            'contacto'=>'required|max:50'
        ];
    }
}
