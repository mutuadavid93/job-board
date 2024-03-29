<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\JoblistingValidationRulesTrait as ValidationRules;

class StoreJoblistingRequest extends FormRequest
{
    use ValidationRules;

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
        $rules = $this->joblistingRules();
        $rules['email'] = 'required|email|unique:companies,email';
        return $rules;
    }
}
