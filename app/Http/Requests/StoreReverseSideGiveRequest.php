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
            'reverse_side_gives' => ['sometimes', 'array'],
            'reverse_side_gives.*.ppe_id' => ['required','exists:ppes,id'],
            'reverse_side_gives.*.date' => ['required_with_all:reverse_side_gives.*.ppe_id,reverse_side_gives.*.quantity,reverse_side_gives.*.percentage_wear,reverse_side_gives.*.cost', 'date'],
            'reverse_side_gives.*.quantity' => ['required_with_all:reverse_side_gives.*.ppe_id,reverse_side_gives.*.date,reverse_side_gives.*.percentage_wear,reverse_side_gives.*.cost', 'numeric', 'min:0'],
            'reverse_side_gives.*.percentage_wear' => ['required_with_all:reverse_side_gives.*.ppe_id,reverse_side_gives.*.date,reverse_side_gives.*.quantity,reverse_side_gives.*.cost', 'numeric', 'between:0,100'],
            'reverse_side_gives.*.cost' => ['required_with_all:reverse_side_gives.*.ppe_id,reverse_side_gives.*.date,reverse_side_gives.*.quantity,reverse_side_gives.*.percentage_wear', 'numeric', 'min:0'],
            'reverse_side_gives.*.signature' => ['sometimes', 'nullable', 'file', 'mimes:pdf'],
            'reverse_side_gives.*.signature_note' => ['sometimes', 'nullable', 'string', 'max:255'],
            'reverse_side_gives.*.sorting' => ['required', 'integer', 'min:0'],
        ];
    }
}
