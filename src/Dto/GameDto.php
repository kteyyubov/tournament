<?php

declare(strict_types=1);

namespace App\Dto;

final class GameDto
{
    public int $id;

    public string $stage;

    public PlayerDto $playerHome;

    public PlayerDto $playerGuest;

    public function __construct(int $id, string $stage, PlayerDto $playerHome, PlayerDto $playerGuest)
    {
        $this->id = $id;
        $this->stage = $stage;
        $this->playerHome = $playerHome;
        $this->playerGuest = $playerGuest;
    }
}
