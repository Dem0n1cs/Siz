<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePersonalCardRequest extends FormRequest
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
        $personalCard = ['user_id' => ['required', 'unique:personal_cards']];
        $frontSide = (new StoreFrontSideRequest())->rules();
        $reverseSideGive = (new StoreReverseSideGiveRequest())->rules();
        $reverseSideReturn = (new StoreReverseSideReturnRequest())->rules();
        return array_merge($personalCard,$frontSide, $reverseSideGive, $reverseSideReturn);
    }
}
