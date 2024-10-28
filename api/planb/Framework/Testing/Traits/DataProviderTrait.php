<?php

declare(strict_types=1);

namespace PlanB\Framework\Testing\Traits;

use PlanB\Framework\Testing\DataLoader\DataProvider;
use PlanB\Framework\Testing\DataLoader\ExpectedException;
use PlanB\Framework\Testing\DataLoader\TestData;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

trait DataProviderTrait
{
	protected function loadTestData(string $className, string $key): TestData
	{
		$provider = DataProvider::getInstance();

		return $provider->loadData($className, $key);
	}

	protected function loadData(string $className, string $key): array
	{
		return $this->loadTestData($className, $key)->getInput();
	}

	protected function loadSingleData(string $className, string $key): mixed
	{
		$data = $this->loadData($className, $key);

		return array_pop($data);
	}

	protected function loadDataSet(string $className): iterable
	{
		$provider = DataProvider::getInstance();

		return $provider->loadDataSet($className);
	}

	protected function assertExpectedException(mixed $expected)
	{
		if (!$expected instanceof ExpectedException) {
			return;
		}

		$this->expectException($expected->getClassName());

		if ($expected->hasMessage()) {
			$this->expectExceptionMessageMatches($expected->getMessage());
		}
	}

	protected function assertSameKeyValues(array|object $expected, array|object $actual, string $message = '')
	{
		$expected = $this->objectNormalize($expected);
		$actual = $this->objectNormalize($actual);

		$this->assertSame($expected, $actual, $message);
	}

	protected function objectNormalize(array|object $input): array
	{
		$normalizer = new ObjectNormalizer();

		$input = is_object($input) ?
			$normalizer->normalize($input) :
			$input;

		ksort($input);

		return $input;
	}
}
