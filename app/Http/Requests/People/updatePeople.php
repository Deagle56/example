<?php

namespace App\Http\Requests\people;

use Illuminate\Foundation\Http\FormRequest;

class updatepeople extends FormRequest
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
            'age' => 'integer|min:3|max:255',
            'number' => 'integer|min:3|max:10000'
        ];
    }
}
