<?php

declare(strict_types=1);

namespace App\Tests\Music\Domain\Model\Traits;

use App\Music\Domain\Input\DiscoListInput;
use App\Music\Domain\Model\DiscoId;
use App\Music\Domain\Model\Traits\DiscoCollectionTrait;
use App\Tests\Music\Doubles\Domain\Model\DiscoDouble;
use App\Tests\Music\Doubles\MusicTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class DiscoCollectionTraitTest extends TestCase
{
    use MusicTrait;

    protected function setUp(): void
    {
        $this->discoId = new DiscoId();
        $sut = (new \ReflectionClass(DiscoCollectionExample::class))
            ->newInstanceWithoutConstructor()
        ;

        $initial = DiscoListInput::collect([
            $this->doubleDisco(fn (DiscoDouble $double) => $double->withId($this->discoId)),
        ]);

        $sut->execute($initial);
        $this->sut = $sut;
    }

    public function test_it_create_an_collection_properly()
    {
        $this->assertCount(1, $this->sut->getDiscos());
        $this->assertSame($this->discoId, $this->sut->getDiscos()->get(0)->getId());
    }

    public function test_it_is_able_to_add_an_existing_element()
    {
        $input = DiscoListInput::collect([
            $this->doubleDisco(fn (DiscoDouble $double) => $double->withId($this->discoId)),
            $this->doubleDisco(),
            $this->doubleDisco(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(3, $this->sut->getDiscos());
        $this->assertSame($this->discoId, $this->sut->getDiscos()->get(0)->getId());
    }

    public function test_it_is_able_to_create_a_new_element()
    {
        $input = DiscoListInput::collect([
            $this->doubleDisco(fn (DiscoDouble $double) => $double->withId($this->discoId)),
            $this->doubleDiscoInput(),
            $this->doubleDiscoInput(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(3, $this->sut->getDiscos());
        $this->assertSame($this->discoId, $this->sut->getDiscos()->get(0)->getId());
    }

    public function test_it_is_able_to_remove_an_element()
    {
        $input = DiscoListInput::collect([
            $this->doubleDisco(),
            $this->doubleDisco(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(2, $this->sut->getDiscos());
        $this->assertNotSame($this->discoId, $this->sut->getDiscos()->get(0)->getId());
    }
}

class DiscoCollectionExample
{
    use DiscoCollectionTrait;

    public function execute(DiscoListInput $input)
    {
        $this->discoCollection($input);
    }
}
