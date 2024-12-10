<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FilterCsvRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Check if the CSV content contains only numeric values (0-9)
        return preg_match('/^[0-9.,\s]+$/', $value);
    }
    public function message()
    {
        return 'The validation message for your rule.';
    }

}
