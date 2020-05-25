<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tests\Data\StrictUserType;
use TypeError;

class StrictEnumTest extends TestCase
{
    public function testCreateEnumWithInvalidType()
    {
        $this->expectException(TypeError::class);

        StrictUserType::MANAGER();
    }
}