<?php

namespace App\Service;

use App\Entity\Aboba;
use App\Entity\MarriedStatusEnum;
use App\Repository\AbobaRepository;

readonly class AbobaService
{
    public function __construct(
        private AbobaRepository $abobaRepository,
    ){}

    public function getByMarriedStatus($marriedStatus){
        return match($marriedStatus){
            MarriedStatusEnum::NOT_MARRIED => $this->abobaRepository->findNotMarried(),
            MarriedStatusEnum::MARRIED => $this->abobaRepository->findMarried(),
            null => $this->abobaRepository->findAll(),
        };
    }

}
