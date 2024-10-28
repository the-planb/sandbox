<?php

declare(strict_types=1);

namespace PlanB\Framework\Testing;

use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

final class StubCreator
{
	private $callaback;

	private function __construct(callable $callback)
	{
		$this->callaback = $callback;
	}

	public static function make(callable $callback)
	{
		return new self($callback);
	}

	private function prophesize(string $classOrInterface): ObjectProphecy
	{
		return ($this->callaback)($classOrInterface);
	}

	/**
	 * @template T
	 *
	 * @param class-string<T> $classOrInterface
	 *
	 * @return ObjectProphecy
	 */
	public function mock(string $classOrInterface, array|callable $methods = []): ObjectProphecy|\UnitEnum
	{
		if (enum_exists($classOrInterface)) {
			return forward_static_call([$classOrInterface, 'cases'])[0];
		}

		$mock = $this->prophesize($classOrInterface);

		if (is_callable($methods)) {
			$methods = $methods($mock);
		}

		$class = new \ReflectionClass($classOrInterface);

		/** @var \ReflectionMethod $method */
		foreach ($class->getMethods() as $method) {
			$name = $method->getName();

			if (isset($methods[$name])) {
				$mock
					->{$name}(Argument::cetera())
					->willReturn($methods[$name])
				;

				continue;
			}

			$returnType = $method->getReturnType();
			if (!$returnType instanceof \ReflectionNamedType) {
				continue;
			}

			$type = $returnType->getName();

			if ('void' === $type) {
				continue;
			}

			$value = match (true) {
				in_array($type, ['self', 'static', $classOrInterface]) => $mock,
				enum_exists($type) => forward_static_call([$type, 'cases'])[0],
				class_exists($type),
				interface_exists($type) => $this->prophesize($type),
				default => match ($type) {
					'object' => new \stdClass(),
					'array', 'iterable' => [],
					'string' => '',
					'int' => 0,
					'float' => 0.1,
					'bool' => true,
					default => null
				}
			};

			$mock
				->{$name}(Argument::cetera())
				->willReturn($value)
			;
		}

		return $mock;
	}
}
