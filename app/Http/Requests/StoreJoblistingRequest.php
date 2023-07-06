<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJoblistingRequest extends FormRequest
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
            'company_logo' => 'nullable|mimes:png,jpg,jpeg',
            'description' => 'required|string|max:65535 ',
            'employment_type' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'experience_level' => 'required|string',
            'company_name' => 'required|string',
        ];
    }
}
