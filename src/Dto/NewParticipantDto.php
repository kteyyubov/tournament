<?php

declare(strict_types=1);

namespace App\Dto;

final class NewParticipantDto
{
    public int $tournamentId;

    public string $name;

    public string $division;

    public function __construct(int $tournamentId, string $name, string $division)
    {
        $this->tournamentId = $tournamentId;
        $this->name = $name;
        $this->division = $division;
    }

}