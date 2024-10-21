<?php
declare(strict_types=1);

namespace PlanB\Framework\Testing;

use Prophecy\Prophecy\ObjectProphecy;

/**
 * @template T
 */
abstract class TestDouble
{
    private string $classOrInterface;
    private readonly ObjectProphecy $double;
    protected $callback;

    protected function __construct(callable $callback, string $classNameOrInterface)
    {
        $this->classOrInterface = $classNameOrInterface;
        $this->callback = $callback;
        $this->reset();
        $this->initialize();
    }

    final protected function reset(): void
    {
        $this->double = ($this->callback)($this->classOrInterface);
    }

    protected function prophesize(string $classOrInterface): ObjectProphecy
    {
        return ($this->callback)($classOrInterface);
    }

    protected function initialize(): void
    {
    }

    final protected function classNameOrInterface(): string
    {
        return $this->classOrInterface;
    }

    final protected function double(): ObjectProphecy
    {
        return $this->double;
    }

    final public function reveal(): object
    {
        $this->finalize();
        return $this->double->reveal();
    }

    protected function finalize(): void
    {
    }

}
