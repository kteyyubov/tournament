<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Tournament;

interface TournamentRepository
{
    public function byId(int $id): ?Tournament;

    public function add(Tournament $tournament): void;

    public function update(Tournament $tournament): void;
}