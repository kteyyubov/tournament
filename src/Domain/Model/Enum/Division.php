<?php

declare(strict_types=1);

namespace App\Domain\Model\Enum;

use App\Domain\Model\EnumTrait;
use MyCLabs\Enum\Enum;

/**
 * @method static self A
 * @method static self B
 */
final class Division extends Enum
{
    use EnumTrait;

    private const A = 'A';
    private const B = 'B';
}