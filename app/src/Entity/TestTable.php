<?php

namespace App\Entity;

use App\Repository\TestTableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestTableRepository::class)]
class TestTable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $field1 = null;

    #[ORM\Column]
    private ?int $field2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getField1(): ?string
    {
        return $this->field1;
    }

    public function setField1(string $field1): static
    {
        $this->field1 = $field1;

        return $this;
    }

    public function getField2(): ?int
    {
        return $this->field2;
    }

    public function setField2(int $field2): static
    {
        $this->field2 = $field2;

        return $this;
    }
}
