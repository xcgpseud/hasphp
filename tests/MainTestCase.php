<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class MainTestCase extends TestCase
{
    public function runTests(array $cases, callable $fnRun): void
    {
        foreach ($cases as $case) {
            call_user_func_array($fnRun, $case);
        }
    }
}