<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmojiBasedCalculatorController extends Controller
{

    /**
     * Perform calculation
     *
     * @param Request $request
     * @return response
     */
    public function calculate(Request $request)
    {
        $request_data = $request->all();

        $validator = \Validator::make($request_data, [
            'first_operand' => 'required|numeric',
            'second_operand' => $request_data['operator'] == 'division' ? 'required|numeric|not_in:0' : 'required|numeric',
            'operator' => 'required|string|in:addition,subtraction,multiplication,division',
            'api_secret_key' => 'required|in:' . ENV('API_SECRET_KEY')
        ], [
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->getMessageBag()->first(),
                'errors' => $validator->getMessageBag(),
            ]);
        }

        $result = null;

        switch($request_data['operator']) {
            case 'addition':
                $result = $request_data['first_operand'] + $request_data['second_operand'];
                break;
            case 'subtraction':
                $result = $request_data['first_operand'] - $request_data['second_operand'];
                break;
            case 'multiplication':
                $result = $request_data['first_operand'] * $request_data['second_operand'];
                break;
            case 'division':
                $result = $request_data['first_operand'] / $request_data['second_operand'];
                break;
            default:
                $result = $result;
        }

        return response()->json([
            'success' => true,
            'message' => 'Calculation is successfully completed',
            'request_data' => $request_data,
            'result' => is_float($result) || is_double($result) ? number_format($result, 2) : $result
        ]);
    }

}
