<?php

namespace App\Model;

class Aboba
{
    public function __construct(
        private int $id,
        private string $name,
        private int $age
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


}
