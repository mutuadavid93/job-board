<?php

namespace App\Traits;

trait JoblistingValidationRulesTrait
{
    public function joblistingRules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'location' => 'required|string|max:100',
            'name' => 'required|string',
            'logo' => 'nullable|mimes:png,jpg,jpeg',
            'overview' => 'required',
            'job_purpose' => 'required',
            'professional_skills' => 'required',
            'responsibilities' => 'required',
            'employment_type' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'experience_level' => 'required|string',
        ];
    }
}
