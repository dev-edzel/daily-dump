<?php

namespace App\Http\Requests;

use App\Rules\AllowedSalesLeadTags;
use Illuminate\Foundation\Http\FormRequest;

class StoreSalesLeadRequest extends FormRequest
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
            'title' => ['required', 'min:5', 'max:255'],
            'message' => ['required', 'min:5'],
            'tags' => ['required', 'array'],
            'tags.*' => [new AllowedSalesLeadTags]
        ];
    }
}
