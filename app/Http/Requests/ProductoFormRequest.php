<?php

namespace Transic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoFormRequest extends FormRequest
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
            'idProveedor'=>'required',    	
            'idMarca'=>'required',
            'idModelo'=>'required',
            'nombre'=>'required|max:50|unique:articulos,nombre,' . $this->id,          
        ];
    }
}
