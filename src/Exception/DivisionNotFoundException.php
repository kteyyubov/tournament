<?php

declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

final class DivisionNotFoundException extends RuntimeException
{
    public static function byId(string $division): self
    {
        return new self("Division {$division} was not found.");
    }
}