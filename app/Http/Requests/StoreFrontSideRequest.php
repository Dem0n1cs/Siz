<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFrontSideRequest extends FormRequest
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
            'front_side' => ['array'],
            'front_side.gender' => ['required','string','max:3'],
            'front_side.height_id' => ['required','string','exists:heights,id'],
            'front_side.clothing_size_id' =>  ['required', 'string','exists:clothing_sizes,id'],
            'front_side.shoe_size' =>  ['required', 'string','regex:/\d{2}/'],
            'front_side.glove_size' =>  ['string'],
            /*'corrective_glasses' =>  ['string'],*/
        ];
    }
}
