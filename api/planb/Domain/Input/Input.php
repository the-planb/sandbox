<?php

namespace PlanB\Domain\Input;

abstract class Input
{
    public static function make(array $data): static
    {
        $input = new static();
        foreach ($data as $key => $value) {
            $input->{$key} = $value;
        }
        return $input;
    }

}
