<?php

namespace qbrema\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjusteFormRequest extends FormRequest
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
            'idajustes'=>'required',
            'movto'=>'required',
            'glosa'=>'required|max:250',
            'fecha'=>'required',
            'cantidad'=>'required'
        ];
    }
}