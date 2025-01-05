<?php

namespace App\Helpers;

class Column
{
    public string $component = 'columns.default-column';

    public string $key;

    public string $label;

    public function __construct(string $key, string $label)
    {
        $this->key = $key;
        $this->label = $label;
    }

    public function component($component)
    {
        $this->component = $component;

        return $this;
    }

    public static function make(string|array $key, string $label)
    {
        return new static($key, $label);
    }
}
