<?php

declare(strict_types=1);

namespace App\Domain\Service\Generator;

use App\Domain\Model\Enum\Stage;
use App\Domain\Model\Game;
use App\Domain\Model\Player;
use App\Domain\Model\Tournament;

final class SemifinalGenerator extends GameGenerator
{
    protected function prepare(Tournament $tournament): array
    {
        $games = [];
        $quarterWinners = [];
        $quarterGames = $tournament->getQuarterfinalGames();

        /** @var Game $quarterGame */
        foreach ($quarterGames as $quarterGame) {
            $quarterWinners[] = $quarterGame->getWinner()->getParticipant();
        }

        foreach (array_chunk($quarterWinners, 2) as $winners) {
            $games[] = new Game(
                $tournament,
                Stage::SEMIFINAL(),
                new Player($winners[0]),
                new Player($winners[1])
            );
        }

        return $games;
    }
}
