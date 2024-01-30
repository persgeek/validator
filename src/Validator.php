<?php

namespace PG\Validator;

use Illuminate\Validation\ValidationException;
use PG\Validator\Validators\Required;
use PG\Validator\Validators\Option;
use PG\Validator\Field\Field;

class Validator
{
    protected $fields = [];

    protected $prices = [];

    public function setField(Field $field)
    {
        $this->fields[] = $field;

        return $this;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function setPrice($price)
    {
        $this->prices[] = $price;

        return $this;
    }

    public function getPrices()
    {
        return $this->prices;
    }

    public function sumPrices()
    {
        return array_sum($this->prices);
    }

    public function validate()
    {
        array_map([$this, 'validateField'], $this->fields);

        return $this;
    }

    public function validateField(Field $field)
    {
        $name = $field->getName();

        $this->requiredValidator($field, $name);

        $options = $field->getOptions();

        if ($options) {
            $this->optionValidator($field, $name);
        }
    }

    protected function requiredValidator(Field $field, $name)
    {
        $value = $this->getValue($name);

        $validator = new Required($name, $value, $field);

        $validate = $validator->validate();

        if (!$validate) {
            $this->showMessage($validator->message());
        }
    }

    protected function optionValidator(Field $field, $name)
    {
        $value = $this->getValue($name);

        $option = $field->findOption($value);

        $validator = new Option($name, $value, $field, $option);

        $validate = $validator->validate();

        if (!$validate) {
            $this->showMessage($validator->message());
        }

        $price = $option->getPrice();

        if ($price) {
            $this->setPrice($price);
        }
    }

    protected function showMessage($message)
    {
        throw ValidationException::withMessages([$message]);
    }

    public function getValue($name, $defaultValue = null)
    {
        $exists = array_key_exists($name, $_POST);

        if ($exists) {
            return $_POST[$name];
        }

        return $defaultValue;
    }

    public function getRawFields()
    {
        $rawFields = [];

        foreach ($this->fields as $field) {

            $name = $field->getName();

            $value = $this->getValue($name);

            $rawFields[$name] = $value;
        }

        return $rawFields;
    }
}
