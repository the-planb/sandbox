<?php

declare(strict_types=1);

namespace App\Tests\Unit\Media\Domain\Model\VO;

use App\Media\Domain\Model\VO\ReleaseYear;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\DataLoader\ExpectedException;
use PlanB\Framework\Testing\Traits\DataProviderTrait;

/**
 * @internal
 */
final class ReleaseYearTest extends TestCase
{
	use DataProviderTrait;

	/**
	 * @dataProvider dataProvider
	 */
	public function test_that_only_can_be_instantiated_with_correct_values(array $data, ?ExpectedException $expected)
	{
		$this->assertExpectedException($expected);
		$releaseYear = new ReleaseYear(...$data);
		$this->assertInstanceOf(ReleaseYear::class, $releaseYear);

		$this->assertSameKeyValues($data, $releaseYear);
	}

	public function dataProvider(): iterable
	{
		return $this->loadDataSet(ReleaseYear::class);
	}

	public function test_that_it_can_be_converted_to_native()
	{
		$input = $this->loadSingleData(ReleaseYear::class, 'happy');
		$releaseYear = new ReleaseYear($input);

		$this->assertEquals($input, $releaseYear->toInt());
	}
}
