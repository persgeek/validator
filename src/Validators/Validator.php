<?php

namespace PG\Validator\Validators;

use PG\Validator\Field\Option;
use PG\Validator\Field\Field;

abstract class Validator
{
    protected $name;
    protected $value;

    protected $field;

    protected $option;

    public function __construct($name, $value, Field $field, Option $option = null)
    {
        $this->name = $name;
        $this->value = $value;

        $this->field = $field;

        $this->option = $option;
    }
}
