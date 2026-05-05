<?php

namespace App\Service;

use App\Entity\MarriedStatusEnum;
use App\Repository\AbobaRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

readonly class AbobaService
{
    public function __construct(
        private AbobaRepository $abobaRepository,
    ){}

    public function getAll(): array
    {
        return $this->abobaRepository->findAllOrdered();
    }
    public function getByMarriedStatus(?MarriedStatusEnum $marriedStatus): array
    {
        if ($marriedStatus !== null) {
            return $this->abobaRepository->findByMarriedStatus($marriedStatus);
        }
        return $this->getAll();
    }

    public function getByMarriedStatusPaginated(?MarriedStatusEnum $marriedStatus, int $page, int $limit = 10): Paginator
    {
        return $this->abobaRepository->findByMarriedStatusPaginated($marriedStatus, $page, $limit);
    }
}
