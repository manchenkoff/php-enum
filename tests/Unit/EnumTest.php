<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tests\Data\UserType;

class EnumTest extends TestCase
{
    public function testEnumCreated()
    {
        $enum = UserType::MANAGER();

        $this->assertInstanceOf(UserType::class, $enum);
    }

    public function testEnumValue()
    {
        $enum = UserType::MANAGER();

        $this->assertEquals('user_manager', $enum->getValue());
    }

    public function testEnumName()
    {
        $enum = UserType::MANAGER();

        $this->assertEquals('MANAGER', $enum->getName());
    }

    public function testEnumTitle()
    {
        $enum = UserType::MANAGER();

        $this->assertEquals('Manager role description', $enum->getTitle());
    }

    public function testEnumIsOperation()
    {
        $manager = UserType::MANAGER();
        $admin = UserType::ADMIN();

        $this->assertTrue($manager->is(UserType::MANAGER()));

        $this->assertNotTrue($manager->is(UserType::ADMIN()));
        $this->assertNotTrue($manager->is($admin));
    }

    public function testEnumEqualsOperation()
    {
        $manager = UserType::MANAGER();
        $admin = UserType::ADMIN();

        $this->assertTrue($manager->eq($manager->getValue()));
        $this->assertTrue($manager->eq(UserType::MANAGER()->getValue()));

        $this->assertNotTrue($manager->is($admin));
        $this->assertNotTrue($admin->eq('ADMIN'));
    }

    public function testValuesList()
    {
        $this->assertCount(
            2,
            UserType::getValues()
        );
    }
}
