<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Participant;
use Doctrine\ORM\EntityManagerInterface;

class OrmParticipantRepository implements ParticipantRepository
{
    private EntityManagerInterface $em;
    private string $className;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->className = Participant::class;
    }

    public function byId(int $id): ?Participant
    {
        return $this->em
            ->getRepository($this->className)
            ->find($id);
    }

    public function add(Participant $participant): void
    {
        $this->em->persist($participant);
        $this->em->flush();
    }

    public function update(Participant $participant): void
    {
        $this->em->persist($participant);
        $this->em->flush();
    }

}