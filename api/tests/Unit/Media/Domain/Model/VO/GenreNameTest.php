<?php

declare(strict_types=1);

namespace App\Tests\Unit\Media\Domain\Model\VO;

use App\Media\Domain\Model\VO\GenreName;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\DataLoader\ExpectedException;
use PlanB\Framework\Testing\Traits\DataProviderTrait;

/**
 * @internal
 */
final class GenreNameTest extends TestCase
{
	use DataProviderTrait;

	/**
	 * @dataProvider dataProvider
	 */
	public function test_that_only_can_be_instantiated_with_correct_values(array $data, ?ExpectedException $expected)
	{
		$this->assertExpectedException($expected);
		$genreName = new GenreName(...$data);
		$this->assertInstanceOf(GenreName::class, $genreName);

		$this->assertSameKeyValues($data, $genreName);
	}

	public function dataProvider(): iterable
	{
		return $this->loadDataSet(GenreName::class);
	}

	public function test_that_it_can_be_converted_to_native()
	{
		$input = $this->loadSingleData(GenreName::class, 'happy');
		$genreName = new GenreName($input);

		$this->assertEquals($input, $genreName->__toString());
	}
}
