<?php

namespace App\DataFixtures;

use App\Entity\MarriedStatusEnum;
use App\Factory\AbobaFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        AbobaFactory::createOne([
            'name' => 'Квазибоба',
            'age' => 12,
            'marriedStatus' => MarriedStatusEnum::MARRIED,
            'createdAt' => new \DateTimeImmutable('2026-04-10'),
        ]);

        AbobaFactory::createOne([
            'name' => 'Адильбек',
            'age' => 48,
            'marriedStatus' => MarriedStatusEnum::NOT_MARRIED,
            'createdAt' => new \DateTimeImmutable('2026-02-08'),
        ]);

        AbobaFactory::createOne([
            'name' => 'Андрюша',
            'age' => 120,
            'marriedStatus' => MarriedStatusEnum::MARRIED,
            'createdAt' => new \DateTimeImmutable('2026-09-01'),
        ]);

        AbobaFactory::createMany(20);
    }
}
