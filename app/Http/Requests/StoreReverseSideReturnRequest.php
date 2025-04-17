<?php

namespace App\Http\Requests;

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
            'reverse_side_returns' => ['sometimes', 'array', 'max:100'],
            'reverse_side_returns.*.date' => ['required_with:reverse_side_returns.*.quantity,reverse_side_returns.*.percentage_wear,reverse_side_returns.*.cost', 'date_format:Y-m-d','nullable'],
            'reverse_side_returns.*.quantity' => ['required_with:reverse_side_returns.*.date,reverse_side_returns.*.percentage_wear,reverse_side_returns.*.cost', 'numeric', 'min:0', 'nullable'],
            'reverse_side_returns.*.percentage_wear' => ['required_with:reverse_side_returns.*.date,reverse_side_returns.*.quantity,reverse_side_returns.*.cost', 'numeric', 'between:0,100', 'nullable'],
            'reverse_side_returns.*.cost' => ['required_with:reverse_side_returns.*.date,reverse_side_returns.*.quantity,reverse_side_returns.*.percentage_wear', 'numeric', 'min:0', 'nullable'],
            'reverse_side_returns.*.signatures' => ['sometimes', 'nullable', 'file', 'mimes:pdf', 'max:2048'],
            'reverse_side_returns.*.signatures_note' => ['sometimes', 'nullable', 'string', 'max:255'],
        ];
    }
}
