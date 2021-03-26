<?php

namespace App\DataFixtures;

use App\Entity\Legume;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $legume1 = new Legume();
        $legume1->setTitle('Patate');
        $legume1->setDescription('trop bon en frite');
        $legume1->setCreatedAt(new \DateTime());
        $manager->persist($legume1);

        $legume2 = new Legume();
        $legume2->setTitle('Courgette');
        $legume2->setDescription('trop bon en frite');
        $legume2->setCreatedAt(new \DateTime());
        $manager->persist($legume2);

        for ($i = 1; $i <= 20; $i++) {
            $legume = new Legume();
            $legume->setTitle('Legume ' . $i);
            $legume->setDescription('trop bon en frite ' . $i);
            $legume->setCreatedAt(new \DateTime());
            $manager->persist($legume);
        }

        $manager->flush();
    }
}
