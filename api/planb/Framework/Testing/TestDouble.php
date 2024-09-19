<?php
declare(strict_types=1);

namespace PlanB\Framework\Testing;

use PlanB\Framework\Testing\Traits\DoubleOfTrait;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * @template T
 */
abstract class TestDouble
{
    use DoubleOfTrait;

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
        $this->configure();
        return $this->double->reveal();
    }

    abstract protected function configure(): void;

}
