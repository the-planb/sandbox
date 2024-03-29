<?php

declare(strict_types=1);

namespace App\Tests\Auth\Domain\Model\Traits;

use App\Auth\Domain\Input\UserListInput;
use App\Auth\Domain\Model\Traits\UserCollectionTrait;
use App\Auth\Domain\Model\UserId;
use App\Tests\Auth\Doubles\AuthTrait;
use App\Tests\Auth\Doubles\Domain\Model\UserDouble;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class UserCollectionTraitTest extends TestCase
{
    use AuthTrait;

    protected function setUp(): void
    {
        $this->userId = new UserId();
        $sut = (new \ReflectionClass(UserCollectionExample::class))
            ->newInstanceWithoutConstructor()
        ;

        $initial = UserListInput::collect([
            $this->doubleUser(fn (UserDouble $double) => $double->withId($this->userId)),
        ]);

        $sut->execute($initial);
        $this->sut = $sut;
    }

    public function test_it_create_an_collection_properly()
    {
        $this->assertCount(1, $this->sut->getUsers());
        $this->assertSame($this->userId, $this->sut->getUsers()->get(0)->getId());
    }

    public function test_it_is_able_to_add_an_existing_element()
    {
        $input = UserListInput::collect([
            $this->doubleUser(fn (UserDouble $double) => $double->withId($this->userId)),
            $this->doubleUser(),
            $this->doubleUser(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(3, $this->sut->getUsers());
        $this->assertSame($this->userId, $this->sut->getUsers()->get(0)->getId());
    }

    public function test_it_is_able_to_create_a_new_element()
    {
        $input = UserListInput::collect([
            $this->doubleUser(fn (UserDouble $double) => $double->withId($this->userId)),
            $this->doubleUserInput(),
            $this->doubleUserInput(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(3, $this->sut->getUsers());
        $this->assertSame($this->userId, $this->sut->getUsers()->get(0)->getId());
    }

    public function test_it_is_able_to_remove_an_element()
    {
        $input = UserListInput::collect([
            $this->doubleUser(),
            $this->doubleUser(),
        ]);

        $this->sut->execute($input);
        $this->assertCount(2, $this->sut->getUsers());
        $this->assertNotSame($this->userId, $this->sut->getUsers()->get(0)->getId());
    }
}

class UserCollectionExample
{
    use UserCollectionTrait;

    public function execute(UserListInput $input)
    {
        $this->userCollection($input);
    }
}
