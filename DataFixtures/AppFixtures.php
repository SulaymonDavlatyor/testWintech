<?php

namespace App\DataFixtures;

use App\Entity\Wallet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $wallet = new Wallet();
        $wallet->setBalance('1000.00');
        $wallet->setCurrency('USD');
        $wallet->setUserId(1);

        $manager->persist($wallet);
        $manager->flush();
    }
}
