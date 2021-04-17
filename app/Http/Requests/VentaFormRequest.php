<?php

namespace qbrema\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaFormRequest extends FormRequest
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
            'idcliente'=>'required',
            'tipodocumento'=>'required|max:20',
            'numero'=>'required|max:20|unique:ventas,numero,NULL,idventa,tipodocumento,'.$this->tipodocumento,
            'fecha'=>'required',
            'vencimiento'=>'required',
            'totalventa'=>'required',
            'idproducto'=>'required',
            'cantidad'=>'required',
            'preciounitario'=>'required'
        ];
    }
}

/*

Valida que el numero sea único cuando el tipodocumento es el mismo.
'numero'=>'required|max:20|unique:ventas,numero,NULL,idventa,tipodocumento,'.$this->tipodocumento,
*/