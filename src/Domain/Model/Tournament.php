<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Exception\TournamentException;
use App\Domain\Model\Enum\Division;
use App\Domain\Model\Enum\TournamentStatus;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DateTimeImmutable;

class Tournament
{
    private const MAX_PARTICIPANTS = 16;

    private int $id;

    private string $name;

    private string $status;

    /**
     * @var Collection | Game[] $games
     */
    private Collection $games;

    /**
     * @var Collection | Participant [] $participants
     */
    private Collection $participants;

    private DateTimeImmutable $createdAt;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->status = TournamentStatus::UPCOMING()->toString();
        $this->games = new ArrayCollection();
        $this->participants = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): TournamentStatus
    {
        return TournamentStatus::fromString($this->status);
    }

    public function start(): void
    {
        if (!$this->getStatus()->isUpcoming() || !$this->isFull()) {
            throw TournamentException::byId($this->id);
        }
        $this->status = TournamentStatus::ONGOING()->toString();
    }

    public function finish(): void
    {
        $this->status = TournamentStatus::FINISHED()->toString();
    }

    /**
     * @return Participant[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    /**
     * @return Game[]
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): void
    {
        $this->games->add($game);
    }

    public function addParticipant(Participant $participant): void
    {
        $this->participants->add($participant);
    }

    public function isFull(): bool
    {
        return $this->participants->count() >= self::MAX_PARTICIPANTS;
    }

    public function getSemifinalGames(): array
    {
        return $this->getGames()->filter(
            fn(Game $game) => $game->getStage()->isSemifinal()
        )->toArray();
    }

    public function getQuarterfinalGames(): array
    {
        return $this->getGames()->filter(
            fn(Game $game) => $game->getStage()->isQuarterfinal()
        )->toArray();
    }

    public function getTopSortedParticipantsByDivision(Division $division): array
    {
        $participants = $this->getParticipantsByDivision($division);

        usort($participants, fn($a, $b) => $b->getPoints() <=> $a->getPoints());

        return $participants;
    }

    public function getParticipantsByDivision(Division $division): array
    {
        return $this->getParticipants()->filter(
            fn(Participant $participant) => $participant->getDivision()->equals($division)
        )->toArray();
    }
}