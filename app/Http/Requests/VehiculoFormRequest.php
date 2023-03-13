<?php

namespace Transic\Http\Requests;

use Transic\Http\Requests\Request;

class VehiculoFormRequest extends Request
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
            'ppu'=>'required|unique:vehiculos,ppu,' . $this->id,  // input tipo:hidden en el form, trae el id
            'idMarca'=>'required',
            'idModelo'=>'required',           
            'tipo'=>'required',
            'combustible'=>'required',
            'anio'=>'required'  
        ];
    }
}
?>