<?php

namespace PG\Validator\Validators;

class Option extends Validator
{
    public function message()
    {
        return trans('validation.in', ['attribute' => $this->name]);
    }

    public function validate()
    {
        return !empty($this->option);
    }
}
