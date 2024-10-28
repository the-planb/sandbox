<?php

declare(strict_types=1);

namespace App\Tests\Unit\Media\Domain\Model\VO;

use App\Media\Domain\Model\VO\MovieTitle;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\DataLoader\ExpectedException;
use PlanB\Framework\Testing\Traits\DataProviderTrait;

/**
 * @internal
 */
final class MovieTitleTest extends TestCase
{
	use DataProviderTrait;

	/**
	 * @dataProvider dataProvider
	 */
	public function test_that_only_can_be_instantiated_with_correct_values(array $data, ?ExpectedException $expected)
	{
		$this->assertExpectedException($expected);
		$movieTitle = new MovieTitle(...$data);
		$this->assertInstanceOf(MovieTitle::class, $movieTitle);

		$this->assertSameKeyValues($data, $movieTitle);
	}

	public function dataProvider(): iterable
	{
		return $this->loadDataSet(MovieTitle::class);
	}

	public function test_that_it_can_be_converted_to_native()
	{
		$input = $this->loadSingleData(MovieTitle::class, 'happy');
		$movieTitle = new MovieTitle($input);

		$this->assertEquals($input, $movieTitle->__toString());
	}
}
