<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Model\Tournament;
use App\Dto\NewTournamentDto;

final class CreateTournamentFactory
{
    public function create(NewTournamentDto $newTournamentDto): Tournament
    {
        return new Tournament(
            $newTournamentDto->name
        );
    }
}