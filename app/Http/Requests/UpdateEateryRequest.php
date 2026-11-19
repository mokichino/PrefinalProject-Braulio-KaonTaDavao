<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEateryRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'district_id' => ['required', 'exists:districts,id'],
            'name' => ['required', 'string', 'max:100', 'unique:eateries,name,' . $this->eatery->id],
            'address' => ['required', 'string', 'max:255'],
            'price_range' => ['required', 'string', 'max:50'],
            'specialty' => ['nullable', 'string', 'max:100'],
            'is_open' => ['sometimes', 'boolean'],
            'permit_no' => ['required', 'string', 'max:255', 'unique:permits,permit_no,' . optional($this->eatery->permit)->id],
            'expires_on' => ['required', 'date'],
            'features' => ['nullable', 'array'],
            'features.*' => ['integer', 'exists:features,id'],
        ];
    }

    public function messages(): array
    {
        return ['name.required' => 'Please enter an eatery name.', 'district_id.required' => 'Please choose a district.'];
    }
}
