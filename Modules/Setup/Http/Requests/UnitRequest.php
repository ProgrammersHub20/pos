<?php

namespace Modules\Setup\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UnitRequest extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'unit_code' => [
                'required',
                'max:255',
                    Rule::unique('units')->ignore($this->unit),
            ],
            'unit_name' => [
                'required',
                'max:255',
                    Rule::unique('units')->ignore($this->unit),
            ],
            'base_unit' => [
                'nullable',
                'numeric'
            ],
            
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
