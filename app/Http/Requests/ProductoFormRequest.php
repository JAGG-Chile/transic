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
        'idproveedor'=>'required',
        'nombre'=>'required|max:150',
        'descripcion'=>'max:150',
        'precio'=>'required',
        'stockactual'=>'required',
        'idcategoria'=>'required',
        'tipo'=>'required|max:1'
        ];
    }
}
