<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculationRequest;

class EmojiBasedCalculatorController extends Controller
{

    /**
     * Perform calculation
     *
     * @param Request $request
     * @return response
     */
    public function calculate(CalculationRequest $request)
    {
        $validated_data = $request->validated();

        $answer = $this->getAnswer($validated_data['first_operand'], $validated_data['second_operand'], $validated_data['operator']);

        return response()->json([
            'success' => true,
            'message' => 'Calculation is successfully completed',
            'request_data' => $validated_data,
            'result' => is_float($answer) || is_double($answer) ? number_format($answer, 2) : $answer
        ]);
    }


    private function getAnswer($first_operand, $second_operand, $operator)
    {
        $answer = null;

        switch($operator) {
            case 'addition':
                $answer = $first_operand + $second_operand;
                break;
            case 'subtraction':
                $answer = $first_operand - $second_operand;
                break;
            case 'multiplication':
                $answer = $first_operand * $second_operand;
                break;
            case 'division':
                $answer = $first_operand / $second_operand;
                break;
            default:
                $answer = $answer;
        }
        
        return $answer;
    }

}
