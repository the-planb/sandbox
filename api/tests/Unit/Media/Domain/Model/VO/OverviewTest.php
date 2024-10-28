<?php

declare(strict_types=1);

namespace App\Tests\Unit\Media\Domain\Model\VO;

use App\Media\Domain\Model\VO\Overview;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\DataLoader\ExpectedException;
use PlanB\Framework\Testing\Traits\DataProviderTrait;

/**
 * @internal
 */
final class OverviewTest extends TestCase
{
	use DataProviderTrait;

	/**
	 * @dataProvider dataProvider
	 */
	public function test_that_only_can_be_instantiated_with_correct_values(array $data, ?ExpectedException $expected)
	{
		$this->assertExpectedException($expected);
		$overview = new Overview(...$data);
		$this->assertInstanceOf(Overview::class, $overview);

		$this->assertSameKeyValues($data, $overview);
	}

	public function dataProvider(): iterable
	{
		return $this->loadDataSet(Overview::class);
	}

	public function test_that_it_can_be_converted_to_native()
	{
		$input = $this->loadSingleData(Overview::class, 'happy');
		$overview = new Overview($input);

		$this->assertEquals($input, $overview->__toString());
	}
}
