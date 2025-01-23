<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'employee_number' => ['required','numeric'],
            'last_name' => ['required','string','max:255'],
            'first_name' => ['required','string','max:255'],
            'middle_name' => ['required','string','max:255'],
            'user_name' => ['required','string','max:255',Rule::unique('users')->ignore($this->user)],
            'division_id' => ['required','string','max:255'],
            'profession_id' => ['required','string','max:255'],
            'email'=>['required','email'],
            /*'password'=>['required','confirmed','min:6'],*/
            'employment'=>['required','date'],
            'role'=>['required'],
            'boss_id'=>['required','exists:users,id'],
            'boss_position'=>['required','string','max:255'],
        ];
    }
}
