<?php

namespace Transic\Http\Requests;

use Transic\Http\Requests\Request;

class ProveedorFormRequest extends Request
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
        //dd($this->id);
        return [
            'rut'=>'required|max:10|unique:proveedores,rut,' . $this->id,
            'nombre'=>'required|max:50|unique:proveedores,nombre,' . $this->id,           
            'direccion'=>'max:100',
            'email'=>'max:50|unique:proveedores,email,' . $this->id,
            'telefono'=>'max:11'
        ];
    }
}
?>