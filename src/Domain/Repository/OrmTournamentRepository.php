<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Tournament;
use Doctrine\ORM\EntityManagerInterface;

final class OrmTournamentRepository implements TournamentRepository
{
    private EntityManagerInterface $em;
    private string $className;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->className = Tournament::class;
    }

    public function byId(int $id): ?Tournament
    {
        return $this->em
            ->getRepository($this->className)
            ->find($id);
    }

    public function add(Tournament $tournament): void
    {
        $this->em->persist($tournament);
        $this->em->flush();
    }

    public function update(Tournament $tournament): void
    {
        $this->em->persist($tournament);
        $this->em->flush();
    }
}