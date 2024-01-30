<?php

namespace PG\Validator\Field;

class Field
{
    protected $name;

    protected $options = [];

    public static function make()
    {
        return new static;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setOption(Option $option)
    {
        $this->options[] = $option;

        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function findOption($value)
    {
        $result = null;

        foreach ($this->options as $option) {

            if ($option->getValue() == $value) {

                $result = $option;
            }
        }

        return $result;
    }
}
