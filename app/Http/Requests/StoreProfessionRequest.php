<?php

namespace App\Http\Requests;


use App\Rules\ProfessionStandards;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProfessionRequest extends FormRequest
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
            'professions.title' => ['required','string','max:255','unique:professions'],
            'standards' => ['required','array'],
            'standards.*.ppe_id' => ['integer'],
            'standards.*.quantity' => ['required','string','max:255'],
            'standards.*.term_wear' => ['required',new ProfessionStandards()]
        ];
    }
    public function messages()
    {
        return [
            'standards' => 'Не выбраны СИЗ',
        ];
    }
}
