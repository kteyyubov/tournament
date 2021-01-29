<?php

declare(strict_types=1);

namespace App\Service;

use App\Domain\Model\Game;
use App\Domain\Repository\TournamentRepository;
use App\Dto\Assemble;
use App\Dto\TournamentDto;

final class PresentTournamentService
{
    private TournamentRepository $tournaments;
    private Assemble $assemble;

    public function __construct(TournamentRepository $tournaments, Assemble $assemble)
    {
        $this->tournaments = $tournaments;
        $this->assemble = $assemble;
    }

    public function getGames(int $tournamentId): TournamentDto
    {
        $tournament = $this->tournaments->byId($tournamentId);

        return $this->assemble->toTournamentDto($tournament);
    }
}