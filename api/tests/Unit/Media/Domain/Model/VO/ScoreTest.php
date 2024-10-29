<?php

declare(strict_types=1);

namespace App\Tests\Unit\Media\Domain\Model\VO;

use App\Media\Domain\Model\VO\Score;
use App\Tests\Double\Media\Domain\Model\VO\ScoreExample;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\DataLoader\ExpectedException;
use PlanB\Framework\Testing\Traits\DataProviderTrait;

/**
 * @internal
 */
final class ScoreTest extends TestCase
{
	use DataProviderTrait;

	#[DataProviderExternal(ScoreExample::class, 'dataSet')]
	public function test_that_only_can_be_instantiated_with_correct_values(array $data, ?ExpectedException $expected)
	{
		$this->assertExpectedException($expected);
		$score = new Score(...$data);

		$this->assertInstanceOf(Score::class, $score);
		$this->assertSameKeyValues($data, $score);
	}
	//
	//    public function dataProvider(): iterable
	//    {
	//        return ScoreExample::make()
	//            ->dataSet();
	//
	// //        return ScoreExample::make()->dataSet();
	//
	//        return ScoreExample::dataSet();
	//        return $this->loadDataSet(Score::class);
	//    }
	//
	//    public function test_that_it_can_be_converted_to_native()
	//    {
	//        $input = $this->loadSingleData(Score::class, 'happy');
	//        $score = new Score($input);
	//
	//        $this->assertEquals($input, $score->toInt());
	//    }
}
