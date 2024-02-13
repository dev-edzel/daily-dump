<?php

namespace App\Http\Requests;

use App\Rules\AllowedAddressType;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'name' => ['required', 'min:5', 'max:255'],
            'contact_number' => ['sometimes', 'numeric'],
            'address_type' => new AllowedAddressType,
            'address' => ['required', 'min:5', 'max:255'],
            'city' => ['required', 'min:5', 'max:255'],
            'postal_code' => ['required', 'min:4', 'max:255'],
        ];
    }
}
