<?php

declare(strict_types=1);

namespace App\Tests\Unit\Media\Domain\Model\VO;

use App\Media\Domain\Model\VO\ReviewContent;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\DataLoader\ExpectedException;
use PlanB\Framework\Testing\Traits\DataProviderTrait;

/**
 * @internal
 */
final class ReviewContentTest extends TestCase
{
	use DataProviderTrait;

	/**
	 * @dataProvider dataProvider
	 */
	public function test_that_only_can_be_instantiated_with_correct_values(array $data, ?ExpectedException $expected)
	{
		$this->assertExpectedException($expected);
		$reviewContent = new ReviewContent(...$data);
		$this->assertInstanceOf(ReviewContent::class, $reviewContent);

		$this->assertSameKeyValues($data, $reviewContent);
	}

	public function dataProvider(): iterable
	{
		return $this->loadDataSet(ReviewContent::class);
	}

	public function test_that_it_can_be_converted_to_native()
	{
		$input = $this->loadSingleData(ReviewContent::class, 'happy');
		$reviewContent = new ReviewContent($input);

		$this->assertEquals($input, $reviewContent->__toString());
	}
}
