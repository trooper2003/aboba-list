<?php

namespace App\Model;

class Aboba
{
    public function __construct(
        private int $id,
        private string $name,
        private int $age,
        private MarriedStatusEnum $marriedStatus
    )  {

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMarriedStatusString(): string
    {
        return $this->marriedStatus->value;
    }

    public function getMarriedStatus(): MarriedStatusEnum
    {
        return $this->marriedStatus;
    }

    public function getMarriedStatusFilename(): string
    {
        return match ($this->marriedStatus) {
            MarriedStatusEnum::MARRIED => 'images/status-married.png',
            MarriedStatusEnum::NOT_MARRIED => 'images/status-not-married.png',
        };
    }

}
