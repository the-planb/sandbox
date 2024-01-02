<?php

namespace PlanB\Framework\Testing;

use Faker\Factory;
use Faker\Generator;

trait FakesTrait
{
    /**
     * @throws \ReflectionException
     */
    private function fake(callable $configurator): string
    {
        $faker = Factory::create();
        $faker->seed('abc');

        return $configurator($faker);
    }

    /**
     * @throws \ReflectionException
     */
    private function string(int $max = 200): string
    {
        return $this->fake(function (Generator $faker) use ($max) {
            if ($max < 5) {
                return substr($faker->text(5), 0, $max);
            }

            return $faker->text($max);
        });
    }

    /**
     * @throws \ReflectionException
     */
    private function stringAtLeastOf(int $min, int $length = 200): string
    {
        return $this->fake(function (Generator $faker) use ($min, $length) {
            return $faker->realTextBetween($min, $min + $length);
        });
    }

    /**
     * @throws \ReflectionException
     */
    private function stringBetween(int $min, int $max): string
    {
        return $this->fake(function (Generator $faker) use ($min, $max) {
            return $faker->realTextBetween($min, $max);
        });
    }

    /**
     * @throws \ReflectionException
     */
    private function int(int $min = null, int $max = null): int
    {
        return $this->fake(function (Generator $faker) use ($min, $max) {
            return $faker->numberBetween($min, $max ?? 2147483647);
        });
    }
}
