<?php

namespace Transic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompraFormRequest extends FormRequest
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
            'idproveedor'=>'required',
            'tipodocumento'=>'required|max:20',
            'numero'=>'required|max:20',
            'fecha'=>'required',
            'vencimiento'=>'required',
            'carpeta'=>'max:20',
            'totalcompra'=>'required',
            'idproducto'=>'required',
            'cantidad'=>'required',
            'preciounitario'=>'required'
        ];
    }
}
