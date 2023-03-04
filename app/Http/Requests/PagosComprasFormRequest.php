<?php

namespace Transic\Http\Requests;

use Transic\Http\Requests\Request;

class PagosComprasFormRequest extends Request
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
            'idcompra'=>'required',
            'fecha'=>'required',
            'monto'=>'required',
            'formapago'=>'required|max:20',
            'detalle'=>'max:150',
            'tipopago'=>'required|max:20'
        ];
    }
}
