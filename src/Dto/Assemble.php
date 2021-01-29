<?php

declare(strict_types=1);

namespace App\Dto;

use App\Domain\Model\Game;
use App\Domain\Model\Participant;
use App\Domain\Model\Player;
use App\Domain\Model\Tournament;

final class Assemble
{
    public function toTournamentDto(Tournament $tournament): TournamentDto
    {
        return new TournamentDto(
            $tournament->getId(),
            $tournament->getName(),
            array_map([$this, 'toGameDto'], $tournament->getGames()->toArray()),
            array_map([$this, 'toParticipantDto'], $tournament->getParticipants()->toArray())
        );
    }

    public function toGameDto(Game $game): GameDto
    {
        return new GameDto(
            $game->getId(),
            $game->getStage()->toString(),
            $this->toPlayerDto($game->getPlayerHome()),
            $this->toPlayerDto($game->getPlayerGuest())
        );
    }

    public function toPlayerDto(Player $player): PlayerDto
    {
        return new PlayerDto(
            $player->getScore(),
            $player->getParticipant()->getName(),
        );
    }

    public function toParticipantDto(Participant $participant): ParticipantDto
    {
        return new ParticipantDto(
            $participant->getId(),
            $participant->getName(),
            $participant->getDivision()->toString(),
            $participant->getPoints()
        );
    }
}