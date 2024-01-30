<?php

namespace PG\Validator\Field;

class Option
{
    protected $value;

    protected $price;

    public static function make()
    {
        return new static;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
