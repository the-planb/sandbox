<?php
declare(strict_types=1);

namespace PlanB\Framework\Testing\Traits;

use PlanB\Framework\Testing\Native\ArrayDummy;
use PlanB\Framework\Testing\Native\IntegerDummy;
use PlanB\Framework\Testing\Native\StringDummy;
use PlanB\Framework\Testing\StubCreator;
use Prophecy\Prophecy\ObjectProphecy;
use UnitEnum;

trait DoubleOfTrait
{

    abstract protected function prophesize(string $classOrInterface): ObjectProphecy;

    /**
     * @template T
     * @param class-string<T> $classOrInterface
     * @return T
     */
    protected function dummy(string $classOrInterface): object
    {
        if (enum_exists($classOrInterface)) {
            return forward_static_call([$classOrInterface, 'cases'])[0];
        }

        return $this->prophesize($classOrInterface)->reveal();
    }

    /**
     * @template T
     * @param class-string<T> $classOrInterface
     * @return T
     */
    protected function stub(string $classOrInterface, array|callable $methods = []): object
    {
        $mock = $this->mock($classOrInterface, $methods);
        return $mock instanceof ObjectProphecy ?
            $mock->reveal() :
            $mock;
    }

    /**
     * @template T
     * @param class-string<T> $classOrInterface
     * @return ObjectProphecy
     */
    protected function mock(string $classOrInterface, array|callable $methods = []): ObjectProphecy|UnitEnum
    {
        return StubCreator::make($this->prophesize(...))
            ->mock($classOrInterface, $methods);
    }

    protected function integer(): IntegerDummy
    {
        return new IntegerDummy();
    }

    protected function string(): StringDummy
    {
        return new StringDummy();
    }

    protected function array(): ArrayDummy
    {
        return new ArrayDummy();
    }
}
