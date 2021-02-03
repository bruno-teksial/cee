<?php

namespace App;

class ArrayCollection
{
    private $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function get(string $input)
    {
        if (empty($input)) {
            throw new \Exception('Input is empty!');
        }
        foreach ($this->array as $key => $value)
        {
            if (preg_match("/$key/", $input)) {
                $this->array = $value;
            }
        }
        return $this;
    }

    public function execute()
    {
        return $this->array;
    }
}