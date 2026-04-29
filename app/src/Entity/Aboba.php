<?php

namespace App\Entity;

use App\Repository\AbobaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbobaRepository::class)]
class Aboba
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(enumType: MarriedStatusEnum::class)]
    private ?MarriedStatusEnum $marriedStatus = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getMarriedStatus(): ?MarriedStatusEnum
    {
        return $this->marriedStatus;
    }

    public function setMarriedStatus(MarriedStatusEnum $marriedStatus): static
    {
        $this->marriedStatus = $marriedStatus;

        return $this;
    }

    public function getMarriedStatusString(): string
    {
        return $this->marriedStatus->getRussian();
    }

    public function getMarriedStatusFilename(): string
    {
        return match ($this->marriedStatus) {
            MarriedStatusEnum::MARRIED => 'images/status-married.png',
            MarriedStatusEnum::NOT_MARRIED => 'images/status-not-married.png',
        };
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
