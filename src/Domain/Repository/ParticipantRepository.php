<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Participant;

interface ParticipantRepository
{
    public function add(Participant $participant): void;

    public function update(Participant $participant): void;

}