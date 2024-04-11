<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreReverseSideGiveRequest extends FormRequest
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
            'reverse_side_gives' => ['array'],
            'reverse_side_gives.*.ppe_id' => ['required','string'],
            'reverse_side_gives.*.date' => ['required_with:reverse_side_gives.*.ppe_id,reverse_side_gives.*.quantity,reverse_side_gives.*.percentage_wear,reverse_side_gives.*.cost,reverse_side_gives.*.signature'],
            'reverse_side_gives.*.quantity' => ['required_with:reverse_side_gives.*.ppe_id,reverse_side_gives.*.date,reverse_side_gives.*.percentage_wear,reverse_side_gives.*.cost,reverse_side_gives.*.signature'],
            'reverse_side_gives.*.percentage_wear' => ['required_with:reverse_side_gives.*.ppe_id,reverse_side_gives.*.date,reverse_side_gives.*.quantity,reverse_side_gives.*.cost,reverse_side_gives.*.signature'],
            'reverse_side_gives.*.cost' => ['required_with:reverse_side_gives.*.ppe_id,reverse_side_gives.*.date,reverse_side_gives.*.quantity,reverse_side_gives.*.percentage_wear,reverse_side_gives.*.signature'],
            'reverse_side_gives.*.signature'=> ['mimes:pdf'/*'required_with:reverse_side_gives.*.ppe_id,reverse_side_gives.*.date,reverse_side_gives.*.quantity,reverse_side_gives.*.percentage_wear,reverse_side_gives.*.cost'*/]
        ];
    }
}
