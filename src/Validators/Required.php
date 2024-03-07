<?php

namespace PG\Validator\Validators;

class Required extends Validator
{
    public function message()
    {
        return trans('validation.required', ['attribute' => $this->name]);
    }

    public function validate()
    {
        $value = trim($this->value);

        if (is_numeric($value)) {
            return true; // Zero is valid
        }
        
        return !empty($value);
    }
}
