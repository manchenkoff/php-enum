# PHP Enum

Basic enumeration implementation in PHP, easy and ready to use.

- *Enum*: to create simple enumeration class
- *StrictEnum*: to create enumeration with strict variables type 

## Installation

You have to run following command to add a dependency to your project

```bash
composer require manchenkov/php-enum
```

or you can add this line to `require` section of `composer.json`

```
"manchenkov/php-enum": "*"
```

## How to use

Create a new class like `UserType.php` and paste the following code example:

```php
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
```

Now You can create a new instance of `UserType` enumeration and work with some methods:

```php
$manager = UserType::MANAGER();

$manager->getName(); // MANAGER
$manager->getValue(); // user_manager
$manager->getTitle(); // Manager role description

$manager->is(UserType::ADMIN()); // false
$manager->eq('user_manager'); // true
```