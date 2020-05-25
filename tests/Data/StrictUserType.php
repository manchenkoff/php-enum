<?php

declare(strict_types=1);

namespace Tests\Data;

use Manchenkov\Enumeration\StrictEnum;

/**
 * @method static StrictUserType MANAGER()
 * @method static StrictUserType ADMIN()
 */
class StrictUserType extends StrictEnum
{
    /**
     * @title Manager role description
     */
    private const MANAGER = 0;

    /**
     * @title Administrator role description
     */
    private const ADMIN = 'user_admin';
}