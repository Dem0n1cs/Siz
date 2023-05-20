<?php

namespace App\Http\Requests;

use App\Rules\UniqueNameEquipment;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipmentRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','string','max:255',new UniqueNameEquipment($this->equipment->id)],
            'classification_id' => ['required', 'string', 'max:255'],
            'wear_period' =>  ['required', 'numeric', 'max:255']
        ];
    }
}
