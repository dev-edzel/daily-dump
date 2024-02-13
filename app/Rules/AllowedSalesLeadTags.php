<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AllowedSalesLeadTags implements ValidationRule
{
    private const ALLOWED_SALES_LEAD_TAGS = [
        'Phone',
        'Email',
        'Warm',
        'Cold',
        'New',
        'Existing',
    ];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, self::ALLOWED_SALES_LEAD_TAGS)) {
            $fail(__('The :attribute must be one of the following types: :types', [
                'attribute' => $attribute,
                'types' => implode(', ', self::ALLOWED_SALES_LEAD_TAGS),
            ]));
        }
    }
}
