<?php

declare(strict_types=1);

namespace App\Domain\Service\Generator;

use App\Domain\Model\Enum\Stage;
use App\Domain\Model\Game;
use App\Domain\Model\Player;

final class FinalGameGenerator extends GameGenerator
{
    protected function prepare($tournament): array
    {
        $semiFinalWinners = [];
        $semiFinalGames = $tournament->getSemifinalGames();

        /** @var Game $semiFinalGame */
        foreach ($semiFinalGames as $semiFinalGame) {
            $semiFinalWinners[] = $semiFinalGame->getWinner()->getParticipant();
        }

        return [
            new Game(
                $tournament,
                Stage::FINAL(),
                new Player($semiFinalWinners[0]),
                new Player($semiFinalWinners[1])
            )
        ];
    }
}