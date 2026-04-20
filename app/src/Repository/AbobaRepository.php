<?php

namespace App\Repository;

use App\Model\Aboba;
use App\Model\MarriedStatusEnum;
use Psr\Log\LoggerInterface;

class AbobaRepository
{
    public function __construct(private readonly LoggerInterface $logger){}
    public function getAll(): array{
        $this->logger->info('All Aboba Repository');

        return [
            new Aboba(0, 'Квазибоба', 12, MarriedStatusEnum::MARRIED),
            new Aboba(1, 'Адильбек', 48, MarriedStatusEnum::NOT_MARRIED),
            new Aboba(2, 'Андрюша', 120, MarriedStatusEnum::MARRIED)
        ];
    }

    public function getOne(int $id): ?Aboba{
        $this->logger->info('One Aboba Repository');
        return $this->getAll()[$id] ?? null;
    }
}
