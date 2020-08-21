<?php

declare(strict_types=1);

namespace App\Rule;


use Illuminate\Contracts\Validation\Rule;

class LowerCase implements Rule
{

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return strtolower((string)$value) === $value;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute must be lowercase.';
    }
}
