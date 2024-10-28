<?php

declare(strict_types=1);

namespace App\Tests\Unit\Media\Domain\Model\VO;

use App\Media\Domain\Model\VO\FullName;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\DataLoader\ExpectedException;
use PlanB\Framework\Testing\Traits\DataProviderTrait;

/**
 * @internal
 */
final class FullNameTest extends TestCase
{
	use DataProviderTrait;

	/**
	 * @dataProvider dataProvider
	 */
	public function test_that_only_can_be_instantiated_with_correct_values(array $data, ?ExpectedException $expected)
	{
		$this->assertExpectedException($expected);
		$fullName = new FullName(...$data);
		$this->assertInstanceOf(FullName::class, $fullName);

		$this->assertSameKeyValues($data, $fullName);
	}

	public function dataProvider(): iterable
	{
		return $this->loadDataSet(FullName::class);
	}
}
