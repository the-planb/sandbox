<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Doctrine\DBAL;

use App\BookStore\Domain\Model\VO\Title;
use App\BookStore\Framework\Doctrine\DBAL\TitleDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class TitleDBALTypeTest extends TestCase
{
    public function test_it_has_the_correct_fqn()
    {
        $type = new TitleDBALType();
        $this->assertEquals(Title::class, $type->getFQN());
    }

    public function test_it_has_the_correct_name()
    {
        $type = new TitleDBALType();
        $this->assertEquals('BookStore.Title', $type->getName());
    }
}
