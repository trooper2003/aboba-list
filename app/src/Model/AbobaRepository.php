<?php

namespace App\Model;

use Psr\Log\LoggerInterface;

class AbobaRepository
{
    public function __construct(private readonly LoggerInterface $logger){}
    public function getAll(): array{
        $this->logger->info('All Aboba Repository');

        return [
            new Aboba(0, 'Квазибоба', 12, MarriedStatusEnum::MARRIED, new \DateTimeImmutable('2026-04-10')),
            new Aboba(1, 'Адильбек', 48, MarriedStatusEnum::NOT_MARRIED, new \DateTimeImmutable('2026-02-08')),
            new Aboba(2, 'Андрюша', 120, MarriedStatusEnum::MARRIED, new \DateTimeImmutable('2025-09-01')),
        ];
    }

    public function getOne(int $id): ?Aboba{
        $this->logger->info('One Aboba Repository');
        return $this->getAll()[$id] ?? null;
    }

}
