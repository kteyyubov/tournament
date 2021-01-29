<?php

declare(strict_types=1);

namespace App\Service;

use App\Domain\Factory\CreateParticipantFactory;
use App\Domain\Model\Enum\Division;
use App\Domain\Repository\TournamentRepository;
use App\Dto\Assemble;
use App\Dto\NewParticipantDto;
use App\Dto\ParticipantDto;
use App\Exception\DivisionNotFoundException;
use App\Exception\TournamentIsFullException;
use App\Exception\TournamentNotFoundException;

final class CreateParticipantService
{
    private CreateParticipantFactory $participantFactory;
    private TournamentRepository $tournaments;
    private Assemble $assemble;

    public function __construct(
        CreateParticipantFactory $participantFactory,
        TournamentRepository $tournaments,
        Assemble $assemble
    ) {
        $this->participantFactory = $participantFactory;
        $this->tournaments = $tournaments;
        $this->assemble = $assemble;
    }

    public function execute(NewParticipantDto $newParticipantDto): ParticipantDto
    {
        $tournament = $this->tournaments->byId($newParticipantDto->tournamentId);

        if (null === $tournament) {
            throw TournamentNotFoundException::byId($newParticipantDto->tournamentId);
        }

        // TODO need additional check equal participant number by group
        if ($tournament->isFull()) {
            throw TournamentIsFullException::byId($newParticipantDto->tournamentId);
        }

        if (!Division::isValid($newParticipantDto->division)) {
            throw DivisionNotFoundException::byId($newParticipantDto->division);
        }

        $newParticipant = $this->participantFactory->create($tournament, $newParticipantDto);
        $tournament->addParticipant($newParticipant);

        $this->tournaments->add($tournament);

        return $this->assemble->toParticipantDto($newParticipant);
    }
}