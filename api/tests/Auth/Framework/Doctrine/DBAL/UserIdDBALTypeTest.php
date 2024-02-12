<?php

declare(strict_types=1);

namespace App\Tests\Auth\Framework\Doctrine\DBAL;

use App\Auth\Domain\Model\UserId;
use App\Auth\Framework\Doctrine\DBAL\UserIdDBALType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 */
class UserIdDBALTypeTest extends TestCase
{
    use ProphecyTrait;

    public function test_it_converts_value_to_php_object_properly()
    {
        $platform = $this->prophesize(AbstractPlatform::class)
            ->reveal()
        ;

        $type = new UserIdDBALType();
        $userId = $type->convertToPHPValue('018d92a8-3d51-60c7-93ba-4f655632e124', $platform);

        $this->assertInstanceOf(UserId::class, $userId);
        $this->assertEquals('018d92a8-3d51-60c7-93ba-4f655632e124', (string) $userId);
    }

    public function test_it_has_the_correct_name()
    {
        $type = new UserIdDBALType();
        $this->assertEquals('Auth.UserId', $type->getName());
    }
}
