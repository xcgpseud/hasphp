<?php

namespace Tests;

class Dog
{
    private string $name, $colour;

    public function __construct(string $name, string $colour)
    {
        $this->name = $name;
        $this->colour = $colour;
    }
}