<?php

declare(strict_types=1);

namespace App\Domain\Service\Generator;

use App\Domain\Model\Game;
use App\Domain\Model\Tournament;

abstract class GameGenerator
{
    protected array $games = [];

    final public function play(Tournament $tournament): Tournament
    {
        $this->games = $this->prepare($tournament);
        $this->run($tournament);

        return $tournament;
    }

    abstract protected function prepare(Tournament $tournament): array;

    protected function run($tournament): void
    {
        /** @var Game $game */
        foreach ($this->games as $key => $game) {
            $game->play();
            $tournament->addGame($game);
            unset($this->games[$key]);
        }
    }
}
