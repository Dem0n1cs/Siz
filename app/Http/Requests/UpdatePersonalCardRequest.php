<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePersonalCardRequest extends FormRequest
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
        $personalCard = ['user_id' => ['required', Rule::unique('personal_cards')->ignore($this->personal_card)]];
        $frontSide = (new UpdateFrontSideRequest())->rules();
        $reverseSideGive = (new UpdateReverseSideGiveRequest())->rules();
        $reverseSideReturn = (new UpdateReverseSideReturnRequest())->rules();
        return array_merge($personalCard, $frontSide, $reverseSideGive, $reverseSideReturn);
    }
}
