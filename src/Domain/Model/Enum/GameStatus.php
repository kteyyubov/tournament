<?php

declare(strict_types=1);

namespace App\Domain\Model\Enum;

use App\Domain\Model\EnumTrait;
use MyCLabs\Enum\Enum;

/**
 * @method static self UPCOMING
 * @method static self FINISHED
 */
final class GameStatus extends Enum
{
    use EnumTrait;

    private const UPCOMING = 'upcoming';
    private const FINISHED = 'finished';

    public function isUpcoming(): bool
    {
        return $this->value === self::UPCOMING;
    }

    public function isFinished(): bool
    {
        return $this->value === self::FINISHED;
    }
}