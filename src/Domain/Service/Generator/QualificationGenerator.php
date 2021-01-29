<?php

declare(strict_types=1);

namespace App\Domain\Service\Generator;

use App\Domain\Model\Enum\Division;
use App\Domain\Model\Enum\Stage;
use App\Domain\Model\Game;
use App\Domain\Model\Participant;
use App\Domain\Model\Player;
use App\Domain\Model\Tournament;

final class QualificationGenerator extends GameGenerator
{
    protected function prepare(Tournament $tournament): array
    {
        $games = [];
        foreach (Division::values() as $division) {
            $participants = $tournament->getParticipantsByDivision($division);
            array_push($games, ...$this->registerQualificationGames($tournament, $participants));
        }

        return $games;
    }

    private function registerQualificationGames(Tournament $tournament, array $participants): array
    {
        $games = [];
        foreach ($participants as $participantHome) {
            foreach ($participants as $participantGuest) {
                if ($participantGuest === $participantHome) {
                    continue;
                }
                $games[] = new Game(
                    $tournament,
                    Stage::QUALIFICATION(),
                    new Player($participantHome),
                    new Player($participantGuest)
                );
            }
        }

        return $games;
    }
}
