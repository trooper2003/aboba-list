<?php

namespace App\DataFixtures;

use App\Entity\Aboba;
use App\Entity\MarriedStatusEnum;
use App\Factory\AbobaFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $aboba1 = new Aboba();
        $aboba1->setName('Квазибоба');
        $aboba1->setAge(12);
        $aboba1->setMarriedStatus(MarriedStatusEnum::MARRIED);
        $aboba1->setCreatedAt(new \DateTimeImmutable('2026-04-10'));

        $aboba2 = new Aboba();
        $aboba2->setName('Адильбек');
        $aboba2->setAge(48);
        $aboba2->setMarriedStatus(MarriedStatusEnum::NOT_MARRIED);
        $aboba2->setCreatedAt(new \DateTimeImmutable('2026-02-08'));

        $aboba3 = new Aboba();
        $aboba3->setName('Андрюша');
        $aboba3->setAge(120);
        $aboba3->setMarriedStatus(MarriedStatusEnum::MARRIED);
        $aboba3->setCreatedAt(new \DateTimeImmutable('2026-09-01'));

        $manager->persist($aboba1);
        $manager->persist($aboba2);
        $manager->persist($aboba3);

        $manager->flush();

        AbobaFactory::createMany(10);
    }
}
