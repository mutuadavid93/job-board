<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobListingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:20',
            'location' => 'required|string|max:20',
            'company_logo' => 'required|file|image|max:2048',
            'description' => 'required|string|max:65535 ',
            'employment_type' => 'required|string',
            'salary' => 'required|numeric|min:0',

            // 'application_deadline' => 'required|date',
            'experience_level' => 'required|string',
            // 'skills' => 'required|string',
            // 'remote' => 'boolean',
            'company_name' => 'required|string',
        ];
    }
}
