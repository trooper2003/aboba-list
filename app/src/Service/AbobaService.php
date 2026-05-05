<?php

namespace App\Service;

use App\Entity\MarriedStatusEnum;
use App\Repository\AbobaRepository;

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
}
