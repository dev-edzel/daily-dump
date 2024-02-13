<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AllowedAddressType implements ValidationRule
{
    private const ALLOWED_ADDRESS_TYPES = [
        'Billing',
        'Delivery',
        'Postal',
    ];

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, self::ALLOWED_ADDRESS_TYPES)) {
            $fail(__('The :attribute must be one of the following types: :types', [
                'attribute' => $attribute,
                'types' => implode(', ', self::ALLOWED_ADDRESS_TYPES),
            ]));
        }
    }
}
