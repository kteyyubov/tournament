<?php

declare(strict_types=1);

namespace App\Domain\Service\Generator;

use App\Domain\Model\Enum\Division;
use App\Domain\Model\Enum\Stage;
use App\Domain\Model\Game;
use App\Domain\Model\Participant;
use App\Domain\Model\Player;
use App\Domain\Model\Tournament;
use Doctrine\Common\Collections\Criteria;

final class QuarterfinalGenerator extends GameGenerator
{
    protected function prepare(Tournament $tournament): array
    {
        $quarterParticipants = [];
        $games = [];

        foreach (Division::values() as $division) {
            $quarterParticipants[] = array_slice($tournament->getTopSortedParticipantsByDivision($division), 0, 4);
        }

        $shuffledPairs = $this->shuffleParticipants($quarterParticipants);

        foreach ($shuffledPairs as $participants) {
            $games[] = new Game(
                    $tournament,
                    Stage::QUARTERFINAL(),
                    new Player($participants[0]),
                    new Player($participants[1])
                );
        }

        return $games;
    }

    private function shuffleParticipants(array $participants): array
    {
        $shuffled = [];
        $length = count($participants[0]);
        for ($i = 0; $i < $length; $i++) {
            $shuffled[] = [$participants[0][$i], $participants[1][($length - 1) - $i]];
        }

        return $shuffled;
    }

}