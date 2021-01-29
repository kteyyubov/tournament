<?php

declare(strict_types=1);

namespace App\Dto;

final class TournamentDto
{
    public int $id;
    public string $name;
    public array $games;
    public array $participants;

    public function __construct(int $id, string $name, array $games, array $participants)
    {
        $this->id = $id;
        $this->name = $name;
        $this->games = $games;
        $this->participants = $participants;
    }
}
