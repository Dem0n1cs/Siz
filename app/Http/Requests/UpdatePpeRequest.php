<?php

namespace App\Http\Requests;

use App\Rules\UniqueNamePpe;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePpeRequest extends FormRequest
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
            'title' => ['required','string','max:255',new UniqueNamePpe($this->ppe->id)],
            'classification_id' => ['required', 'string', 'max:255']
        ];
    }
}
