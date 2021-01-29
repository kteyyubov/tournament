<?php

declare(strict_types=1);

namespace App\Domain\Model\Enum;

use App\Domain\Model\EnumTrait;
use MyCLabs\Enum\Enum;

/**
 * @method static self QUALIFICATION
 * @method static self QUARTERFINAL
 * @method static self SEMIFINAL
 * @method static self BRONZE_MEDAL_GAME
 * @method static self FINAL
 */
final class Stage extends Enum
{
    use EnumTrait;

    private const QUALIFICATION = 'qualification';
    private const QUARTERFINAL = 'quarterfinal';
    private const SEMIFINAL = 'semifinal';
    private const BRONZE_MEDAL_GAME = 'bronze_medal_game';
    private const FINAL = 'final';

    public function isQualification(): bool
    {
        return $this->value === self::QUALIFICATION;
    }

    public function isQuarterfinal(): bool
    {
        return $this->value === self::QUARTERFINAL;
    }

    public function isSemifinal(): bool
    {
        return $this->value === self::SEMIFINAL;
    }

    public function isBronzeMedalGame(): bool
    {
        return $this->value === self::BRONZE_MEDAL_GAME;
    }

    public function isFinal(): bool
    {
        return $this->value === self::FINAL;
    }
}