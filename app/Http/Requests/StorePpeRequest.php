<?php

namespace App\Http\Requests;

use App\Rules\UniqueNamePpe;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePpeRequest extends FormRequest
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
            'title' => ['required','string','max:255',new UniqueNamePpe()],
            'short_title'=>['required','string','max:255'],
            'classification_id' => ['required', 'string', 'max:255']
        ];
    }
}
