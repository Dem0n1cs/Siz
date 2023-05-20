<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDivisionRequest extends FormRequest
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
            'department_id' =>'required|string|max:255',
            'short_title' => ['required','string','max:255',
                Rule::unique('divisions')
                    ->where('department_id', $this->department_id)
                    ->ignore($this->division)
            ],
            'full_title' =>  ['required','string','max:255',
                Rule::unique('divisions')
                    ->where('department_id', $this->department_id)
                    ->ignore($this->division)
            ],
        ];
    }
}
