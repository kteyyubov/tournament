<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Model\Enum\GameStatus;
use App\Domain\Model\Enum\Stage;
use DateTimeImmutable;

class Game
{
    private int $id;

    private string $stage;

    private string $status;

    private Tournament $tournament;

    private Player $playerHome;

    private Player $playerGuest;

    private DateTimeImmutable $createdAt;

    public function __construct(
        Tournament $tournament,
        Stage $stage,
        Player $playerHome,
        Player $playerGuest
    )
    {
        $this->stage = $stage->toString();
        $this->status = GameStatus::UPCOMING()->toString();
        $this->tournament = $tournament;
        $this->playerHome = $playerHome;
        $this->playerGuest = $playerGuest;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getStage(): Stage
    {
        return Stage::fromString($this->stage);
    }

    public function getStatus(): GameStatus
    {
        return GameStatus::fromString($this->status);
    }

    public function getTournament(): Tournament
    {
        return $this->tournament;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPlayerHome(): Player
    {
        return $this->playerHome;
    }

    public function getPlayerGuest(): Player
    {
        return $this->playerGuest;
    }

    public function play(): void
    {
        $players = [$this->playerGuest, $this->playerHome];
        $winner = $players[mt_rand(0,1)];

        /** @var Player $winner */
        $winner->setScore(1);
        $winner->getParticipant()->addPointForWin();

        $this->status = GameStatus::FINISHED()->toString();
    }

    public function getWinner(): Player
    {
        return $this->playerGuest->getScore() > $this->playerHome->getScore()
            ? $this->playerGuest
            : $this->playerHome;
    }

    public function getLoser(): Player
    {
        return $this->playerGuest->getScore() < $this->playerHome->getScore()
            ? $this->playerGuest
            : $this->playerHome;
    }
}