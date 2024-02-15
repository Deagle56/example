<?php

namespace App\Http\Requests\cat;

use Illuminate\Foundation\Http\FormRequest;

class updateCat extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
            return [
                'name' => 'string|min:5|max:255',
                'gender' => 'string|min:3|max:255',
                'color' => 'string|min:3|max:255'
            ];
    }
}
