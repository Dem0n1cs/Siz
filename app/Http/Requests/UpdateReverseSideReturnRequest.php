<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReverseSideReturnRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'reverse_side_returns' => ['array'],
            'reverse_side_returns.*.id' => ['present','nullable'],
            'reverse_side_returns.*.date' => ['string','nullable','required_with:reverse_side_returns.*.quantity,reverse_side_returns.*.percentage_wear,reverse_side_returns.*.cost,reverse_side_returns.*.signatures'],
            'reverse_side_returns.*.quantity' => ['string','nullable','required_with:reverse_side_returns.*.date,reverse_side_returns.*.percentage_wear,reverse_side_returns.*.cost,reverse_side_returns.*.signatures'],
            'reverse_side_returns.*.percentage_wear' => ['string','nullable','required_with:reverse_side_returns.*.date,reverse_side_returns.*.quantity,reverse_side_returns.*.cost,reverse_side_returns.*.signatures'],
            'reverse_side_returns.*.cost' => ['string','nullable','required_with:reverse_side_returns.*.date,reverse_side_returns.*.quantity,reverse_side_returns.*.percentage_wear,reverse_side_returns.*.signatures'],
            'reverse_side_returns.*.signatures'=>['mimes:pdf'/*'required_with:reverse_side_returns.*.date,reverse_side_returns.*.quantity,reverse_side_returns.*.percentage_wear,reverse_side_returns.*.cost'*/]

        ];


    }
}
