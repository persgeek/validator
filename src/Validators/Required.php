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
        return !empty($this->value);
    }
}
