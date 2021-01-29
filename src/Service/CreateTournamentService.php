<?php

declare(strict_types=1);

namespace App\Service;

use App\Domain\Factory\CreateTournamentFactory;
use App\Domain\Repository\TournamentRepository;
use App\Dto\Assemble;
use App\Dto\NewTournamentDto;
use App\Dto\TournamentDto;

final class CreateTournamentService
{
    private TournamentRepository $tournaments;
    private CreateTournamentFactory $tournamentFactory;
    private Assemble $assemble;

    public function __construct(
        TournamentRepository $tournaments,
        CreateTournamentFactory $tournamentFactory,
        Assemble $assemble
    ) {
        $this->tournaments = $tournaments;
        $this->tournamentFactory = $tournamentFactory;
        $this->assemble = $assemble;
    }

    public function execute(NewTournamentDto $newTournamentDto): TournamentDto
    {
        $newTournament = $this->tournamentFactory->create($newTournamentDto);
        $this->tournaments->add($newTournament);

        return $this->assemble->toTournamentDto($newTournament);
    }
}