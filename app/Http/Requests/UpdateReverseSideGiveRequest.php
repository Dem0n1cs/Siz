<?php

namespace App\Http\Requests;

use App\Rules\FileOrPath;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReverseSideGiveRequest extends FormRequest
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
            'reverse_side_gives' => ['array'],
            'reverse_side_gives.*.id' => ['present','nullable'],
            'reverse_side_gives.*.ppe_id' => ['required','string'],
            'reverse_side_gives.*.date' => ['string','nullable','required_with:reverse_side_gives.*.ppe_id,reverse_side_gives.*.quantity,reverse_side_gives.*.percentage_wear,reverse_side_gives.*.cost,reverse_side_gives.*.signature'],
            'reverse_side_gives.*.quantity' => ['string','nullable','required_with:reverse_side_gives.*.ppe_id,reverse_side_gives.*.date,reverse_side_gives.*.percentage_wear,reverse_side_gives.*.cost,reverse_side_gives.*.signature'],
            'reverse_side_gives.*.percentage_wear' => ['string','nullable','required_with:reverse_side_gives.*.ppe_id,reverse_side_gives.*.date,reverse_side_gives.*.quantity,reverse_side_gives.*.cost,reverse_side_gives.*.signature'],
            'reverse_side_gives.*.cost' => ['string','nullable','required_with:reverse_side_gives.*.ppe_id,reverse_side_gives.*.date,reverse_side_gives.*.quantity,reverse_side_gives.*.percentage_wear,reverse_side_gives.*.signature'],
            'reverse_side_gives.*.signature'=>['sometimes','file','mimes:pdf'/*,'required_with:reverse_side_gives.*.ppe_id,reverse_side_gives.*.date,reverse_side_gives.*.quantity,reverse_side_gives.*.percentage_wear,reverse_side_gives.*.cost'*/],
            'reverse_side_gives.*.existing_signature' => ['sometimes', 'nullable', 'string'],
            'reverse_side_gives.*.signature_note'=>['string','nullable'],
            'reverse_side_gives.*.sorting' => ['required','integer']
        ];
    }
}
