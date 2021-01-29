<?php

declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

final class TournamentNotFoundException extends RuntimeException
{
    public static function byId(int $id): self
    {
        return new self("Tournament by id {$id} was not found.");
    }
}