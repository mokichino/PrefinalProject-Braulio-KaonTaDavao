<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEateryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['is_open' => $this->boolean('is_open')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $eatery = $this->route('eatery');
        $permitId = $eatery?->permit?->id;

        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('eateries', 'name')->ignore($eatery?->id)],
            'district_id' => ['required', 'exists:districts,id'],
            'address' => ['required', 'string', 'max:255'],
            'price_range' => ['required', 'in:budget,mid,splurge'],
            'specialty' => ['nullable', 'string', 'max:100'],
            'is_open' => ['boolean'],
            'features' => ['required', 'array', 'min:1'],
            'features.*' => ['exists:features,id'],
            'permit_no' => ['required', 'regex:/^DVO-\d{4}-\d{4,5}$/', Rule::unique('permits', 'permit_no')->ignore($permitId)],
            'expires_on' => ['required', 'date', 'after:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Braulio, please enter an eatery name.',
            'district_id.required' => 'Braulio, please choose a district.',
            'address.required' => 'Braulio, please enter an address.',
            'price_range.required' => 'Braulio, please choose a price range.',
            'features.required' => 'Braulio, please select at least one feature.',
            'permit_no.required' => 'Braulio, please enter a permit number.',
            'expires_on.required' => 'Braulio, please enter a permit expiry date.',
        ];
    }
}
