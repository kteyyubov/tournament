<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Model\Enum\Division;
use App\Domain\Model\Participant;
use App\Dto\NewParticipantDto;
use App\Domain\Model\Tournament;

final class CreateParticipantFactory
{
    public function create(Tournament $tournament, NewParticipantDto $newParticipantDto): Participant
    {
        return new Participant(
            $newParticipantDto->name,
            $tournament,
            Division::fromString($newParticipantDto->division)
        );
    }
}