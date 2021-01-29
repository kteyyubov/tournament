<?php

declare(strict_types=1);

namespace App\Domain\Service\Workflow;

use App\Domain\Model\Tournament;

interface TournamentWorkflow
{
    public function execute(Tournament $tournament): void;
}