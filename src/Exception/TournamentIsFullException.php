<?php

declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

final class  TournamentIsFullException extends RuntimeException
{
    public static function byId(int $id): self
    {
        return new self("Tournament by id {$id} is full.");
    }
}