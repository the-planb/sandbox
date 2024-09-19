<?php
declare(strict_types=1);

namespace PlanB\Framework\Testing\Traits;

use Exception;
use PlanB\Framework\Testing\TestDouble;
use Prophecy\PhpUnit\ProphecyTrait;

trait DoublesTrait
{
    use DoubleOfTrait;
    use ProphecyTrait;


    /**
     * @template T of TestDouble
     * @param class-string<T> $classOrInterface
     * @return  T
     * @throws Exception
     */
    public function createDouble(string $classOrInterface): TestDouble
    {
        if (!is_subclass_of($classOrInterface, TestDouble::class)) {
            throw new Exception("{$classOrInterface} no es un TestDouble");
        }

        return new $classOrInterface($this->prophesize(...));
    }


}
