<?php

declare(strict_types=1);

namespace App\Service;

use App\Domain\Exception\TournamentException;
use App\Domain\Repository\TournamentRepository;
use App\Domain\Service\Workflow\TournamentWorkflow;
use App\Exception\TournamentNotFoundException;
use Exception;

final class PlayTournamentService
{
    private TournamentRepository $tournaments;
    private TournamentWorkflow $tournamentWorkflow;

    public function __construct(
        TournamentRepository $tournaments,
        TournamentWorkflow $sixteenTeamWorkflow
    ) {
        $this->tournaments = $tournaments;
        $this->tournamentWorkflow = $sixteenTeamWorkflow;
    }

    public function execute(int $tournamentId): void
    {
        $tournament = $this->tournaments->byId($tournamentId);

        if (null === $tournament) {
            throw TournamentNotFoundException::byId($tournamentId);
        }

        $tournament->start();
        $this->tournamentWorkflow->execute($tournament);
        $tournament->finish();

        $this->tournaments->update($tournament);
    }
}