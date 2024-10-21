<?php
declare(strict_types=1);

namespace PlanB\Framework\Testing\Traits;

use PlanB\Framework\Testing\StubCreator;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use UnitEnum;

trait DoublesTrait
{

    use ProphecyTrait;

    abstract protected function prophesize(string $classOrInterface): ObjectProphecy;

    /**
     * @template T
     * @param class-string<T> $classOrInterface
     * @return T
     */
    private function dummy(string $classOrInterface): object
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
    private function stub(string $classOrInterface, array|callable $methods = []): object
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
    private function mock(string $classOrInterface, array|callable $methods = []): ObjectProphecy|UnitEnum
    {
        return StubCreator::make($this->prophesize(...))
            ->mock($classOrInterface, $methods);
    }



}
