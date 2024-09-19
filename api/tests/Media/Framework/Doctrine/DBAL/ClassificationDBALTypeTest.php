<?php

declare(strict_types=1);

namespace App\Tests\Media\Framework\Doctrine\DBAL;

use App\Media\Domain\Model\VO\Classification;
use App\Media\Framework\Doctrine\DBAL\ClassificationDBALType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use PHPUnit\Framework\TestCase;
use PlanB\Framework\Testing\Traits\DoublesTrait;

/**
 * @internal
 */
final class ClassificationDBALTypeTest extends TestCase
{
    use DoublesTrait;

    public function test_it_creates_a_new_instance_properly()
    {
        $type = new ClassificationDBALType();
        $this->assertInstanceOf(ClassificationDBALType::class, $type);
    }

    public function test_it_configures_sql_platform_properly()
    {
        $column = $this->array()->dummy();
        $columnSql = $this->string()->dummy();

        $type = new ClassificationDBALType();
        $platform = $this->mock(AbstractPlatform::class);
        $platform->getStringTypeDeclarationSQL($column)
            ->shouldBeCalledOnce()
            ->willReturn($columnSql)
        ;

        $type->getSQLDeclaration($column, $platform->reveal());
    }

    public function test_it_has_the_proper_name()
    {
        $type = new ClassificationDBALType();
        $this->assertEquals('Media.Classification', $type->getName());
    }

    public function test_it_has_the_proper_fqn()
    {
        $type = new ClassificationDBALType();
        $this->assertEquals(Classification::class, $type->getFqn());
    }
}
