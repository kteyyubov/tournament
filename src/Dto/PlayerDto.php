<?php

declare(strict_types=1);

namespace App\Dto;

final class PlayerDto
{
    public int $score;

    public string $participantName;


    public function __construct(int $score, string $participantName)
    {
        $this->score = $score;
        $this->participantName = $participantName;
    }
}
