<?php

declare(strict_types=1);

namespace Tests\Data;

use Manchenkov\Enumeration\Enum;

/**
 * @method static UserType MANAGER()
 * @method static UserType ADMIN()
 */
class UserType extends Enum
{
    /**
     * @title Manager role description
     */
    private const MANAGER = 'user_manager';

    /**
     * @title Administrator role description
     */
    private const ADMIN = 'user_admin';
}