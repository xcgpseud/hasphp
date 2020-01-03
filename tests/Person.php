<?php

namespace Tests;

class Person
{
    public string $fName, $lName;
    public int $age;

    public function __construct(string $fName, string $lName, int $age)
    {
        $this->fName = $fName;
        $this->lName = $lName;
        $this->age = $age;
    }
}