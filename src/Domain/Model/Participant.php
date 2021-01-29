<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Model\Enum\Division;
use DateTimeImmutable;

class Participant
{
    private int $id;

    private string $name;

    private string $division;

    private int $points;

    private Tournament $tournament;

    private DateTimeImmutable $createdAt;

    public function __construct(
        string $name,
        Tournament $tournament,
        Division $division
    ) {
        $this->name = $name;
        $this->tournament = $tournament;
        $this->division = $division->toString();
        $this->points = 0;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDivision(): Division
    {
        return Division::fromString($this->division);
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function addPointForWin(): void
    {
        $this->points++;
    }

    public function getTournament(): Tournament
    {
        return $this->tournament;
    }
}
