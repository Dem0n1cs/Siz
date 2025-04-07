<?php

namespace App\Http\Requests;

use App\Rules\FileOrPath;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreReverseSideReturnRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'reverse_side_returns.*.date' => ['required_with:reverse_side_returns.*.quantity,reverse_side_returns.*.percentage_wear,reverse_side_returns.*.cost,reverse_side_returns.*.signatures'],
            'reverse_side_returns.*.quantity' => ['required_with:reverse_side_returns.*.date,reverse_side_returns.*.percentage_wear,reverse_side_returns.*.cost,reverse_side_returns.*.signatures'],
            'reverse_side_returns.*.percentage_wear' => ['required_with:reverse_side_returns.*.date,reverse_side_returns.*.quantity,reverse_side_returns.*.cost,reverse_side_returns.*.signatures'],
            'reverse_side_returns.*.cost' => ['required_with:reverse_side_returns.*.date,reverse_side_returns.*.quantity,reverse_side_returns.*.percentage_wear,reverse_side_returns.*.signatures'],
            'reverse_side_returns.*.signatures'=>['mimes:pdf','sometimes'/*'required_with:reverse_side_returns.*.date,reverse_side_returns.*.quantity,reverse_side_returns.*.percentage_wear,reverse_side_returns.*.cost'*/],
            'reverse_side_returns.*.signatures_note'=>['string','nullable']
        ];
    }
}
