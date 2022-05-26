<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CalculationRequest extends FormRequest
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
            'first_operand' => 'required|numeric',
            'operator' => 'required|string|in:addition,subtraction,multiplication,division',
            'second_operand' => FormRequest::get('operator') == 'division' ? 'required|numeric|not_in:0' : 'required|numeric',
            'api_secret_key' => 'required|in:' . ENV('API_SECRET_KEY')
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_operand.required' => 'First operand is required.',
            'first_operand.numeric' => 'First operand must have a numeric value.',
            'second_operand.required' => 'Second operand is required.',
            'second_operand.numeric' => 'Second operand must have a numeric value.',
            'second_operand.not_in' => 'Second operand must not be 0 for division.',
            'operator.required' => 'Operator is required.',
            'operator.string' => 'Operator must have a string value.',
            'operator.in' => 'Invalid operator.',
            'api_secret_key.required' => 'API secret key is required.',
            'api_secret_key.in' => 'API secret key does not match.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'request_data' => FormRequest::all(),
            'errors'      => $validator->errors()
        ]));
    }
}
