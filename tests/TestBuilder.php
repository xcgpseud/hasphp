<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class TestBuilder extends TestCase
{
    private $in, $expected, $runFn;

    /**
     * @return static
     */
    public static function make(): self
    {
        return new self();
    }

    /**
     * @param $in
     * @return $this
     */
    public function in($in): self
    {
        $this->in = $in;
        return $this;
    }

    /**
     * @param $expected
     * @return $this
     */
    public function expect($expected): self
    {
        $this->expected = $expected;
        return $this;
    }

    /**
     * @param $runFn
     * @return $this
     */
    public function fn ($runFn): self
    {
        $this->runFn = $runFn;
        return $this;
    }

    /**
     * Test with assertEquals on (fn(in), out)
     */
    public function runTestEquals(): void
    {
        $result = call_user_func($this->runFn, $this->in);
        $this->assertEquals($this->expected, $result);
    }

    /**
     * Test with expectException on (fn(in), out)
     */
    public function runTestException(): void
    {
        $this->expectException($this->expected);
        call_user_func($this->runFn, $this->in);
    }
}