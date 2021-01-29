<?php

declare(strict_types=1);

namespace App\Domain\Service\Workflow;

use App\Domain\Model\Tournament;
use App\Domain\Repository\TournamentRepository;
use App\Domain\Service\Generator\GameGenerator;

final class SixteenTeamsWorkflow implements TournamentWorkflow
{
    /**
     * @var GameGenerator[]
     */
    private array $stages = [];

    public function __construct(iterable $stages)
    {
        foreach ($stages as $stage) {
            $this->stages[] = $stage;
        }
    }

    public function execute(Tournament $tournament): void
    {
        foreach ($this->stages as $stage) {
            $stage->play($tournament);
        }
    }
}
