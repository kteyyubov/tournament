<?php

declare(strict_types=1);

namespace App\Dto;

final class NewTournamentDto
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
