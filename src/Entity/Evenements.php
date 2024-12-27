<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EvenementsRepository;

#[ORM\Entity(repositoryClass: EvenementsRepository::class)]
class Evenements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomEvenement = null;

    #[ORM\Column(length: 10000)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $DatePublication = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEvenement(): ?string
    {
        return $this->NomEvenement;
    }

    public function setNomEvenement(string $NomEvenement): static
    {
        $this->NomEvenement = $NomEvenement;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeImmutable
    {
        return $this->DatePublication;
    }

    public function setDatePublication(\DateTimeImmutable $DatePublication): static
    {
        $this->DatePublication = $DatePublication;

        return $this;
    }
}
