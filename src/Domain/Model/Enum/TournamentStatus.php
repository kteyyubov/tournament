<?php

declare(strict_types=1);

namespace App\Domain\Model\Enum;

use App\Domain\Model\EnumTrait;
use MyCLabs\Enum\Enum;

/**
 * @method static self UPCOMING
 * @method static self ONGOING
 * @method static self FINISHED
 */
final class TournamentStatus extends Enum
{
    use EnumTrait;

    private const UPCOMING = 'upcoming';
    private const ONGOING = 'ongoing';
    private const FINISHED = 'finished';

    public function isUpcoming(): bool
    {
        return $this->value === self::UPCOMING;
    }

    public function isOngoing(): bool
    {
        return $this->value === self::ONGOING;
    }

    public function isFinished(): bool
    {
        return $this->value === self::FINISHED;
    }
}