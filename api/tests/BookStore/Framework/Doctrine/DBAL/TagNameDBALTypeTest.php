<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Framework\Doctrine\DBAL;

use App\BookStore\Domain\Model\VO\TagName;
use App\BookStore\Framework\Doctrine\DBAL\TagNameDBALType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class TagNameDBALTypeTest extends TestCase
{
    public function test_it_has_the_correct_fqn()
    {
        $type = new TagNameDBALType();
        $this->assertEquals(TagName::class, $type->getFQN());
    }

    public function test_it_has_the_correct_name()
    {
        $type = new TagNameDBALType();
        $this->assertEquals('BookStore.TagName', $type->getName());
    }
}
