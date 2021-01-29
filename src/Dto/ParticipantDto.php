<?php

declare(strict_types=1);

namespace App\Dto;

final class ParticipantDto
{
    public int $id;

    public string $name;

    public string $division;

    public int $points;

    public function __construct(int $id, string $name, string $division, int $points)
    {
        $this->id = $id;
        $this->name = $name;
        $this->division = $division;
        $this->points = $points;
    }
}
