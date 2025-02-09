<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchDomainRequest extends FormRequest
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
            'domain' => ['required', 'string', 'min:3', 'regex:/^[a-zA-Z0-9-]+$/'],
            'extension' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'domain.required' => 'Please enter a domain name',
            'domain.string' => 'Domain name must be a string',
            'domain.min' => 'Domain name must be at least 3 characters',
            'domain.regex' => 'Domain name must contain only letters, numbers, and hyphens',
            'extension.required' => 'Please select a domain extension',
            'extension.string' => 'Domain extension must be a string',
        ];
    }
}
