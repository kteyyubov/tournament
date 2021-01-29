<?php

declare(strict_types=1);

namespace App\Domain\Model;

use DateTimeImmutable;

class Player
{
    private int $id;

    private Participant $participant;

    private int $score;

    private DateTimeImmutable $createdAt;

    public function __construct(Participant $participant, int $score = 0)
    {
        $this->participant = $participant;
        $this->score = $score;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getParticipant(): Participant
    {
        return $this->participant;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }


}