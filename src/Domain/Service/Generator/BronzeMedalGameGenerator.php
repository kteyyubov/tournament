<?php

declare(strict_types=1);

namespace App\Domain\Service\Generator;

use App\Domain\Model\Enum\Stage;
use App\Domain\Model\Game;
use App\Domain\Model\Player;
use App\Domain\Model\Tournament;

final class BronzeMedalGameGenerator extends GameGenerator
{
    protected function prepare(Tournament $tournament): array
    {
        $semiFinalLoser = [];
        $semiFinalGames = $tournament->getSemifinalGames();

        /** @var Game $semiFinalGame */
        foreach ($semiFinalGames as $semiFinalGame) {
            $semiFinalLoser[] = $semiFinalGame->getLoser()->getParticipant();
        }

        return [
            new Game(
                $tournament,
                Stage::BRONZE_MEDAL_GAME(),
                new Player($semiFinalLoser[0]),
                new Player($semiFinalLoser[1])
            )
        ];
    }
}
