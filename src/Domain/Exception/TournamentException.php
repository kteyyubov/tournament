<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use RuntimeException;

final class TournamentException extends RuntimeException
{
    public static function byId(int $id): self
    {
        return new self("Tournament by id {$id} cannot be started.");
    }
}