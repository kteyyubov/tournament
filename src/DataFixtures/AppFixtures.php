<?php

namespace App\DataFixtures;

use App\Domain\Model\Enum\Division;
use App\Domain\Model\Participant;
use App\Domain\Model\Tournament;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tournament = new Tournament('FIFA'. mt_rand (1800, 2020));
        $manager->persist($tournament);

        foreach (Division::values() as $division){
            for ($i = 0; $i < 8; $i++) {
                $participant = new Participant('Country'. $i . $division, $tournament, $division);
                $manager->persist($participant);
            }
        }
        $manager->flush();
    }
}
