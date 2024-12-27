<?php

namespace App\Entity;

use App\Repository\EmploiTempsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmploiTempsRepository::class)]
class EmploiTemps
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $Jour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $HeureDebut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $HeureFin = null;

    #[ORM\ManyToOne(inversedBy: 'emploiTemps')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Salles $NomSalle = null;

    #[ORM\ManyToOne(inversedBy: 'emploiTemps')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Professeurs $Prenom = null;

    #[ORM\ManyToOne(inversedBy: 'emploiTemps')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matieres $Matiere = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->Jour;
    }

    public function setJour(string $Jour): static
    {
        $this->Jour = $Jour;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->HeureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $HeureDebut): static
    {
        $this->HeureDebut = $HeureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->HeureFin;
    }

    public function getNomSalle(): ?Salles
    {
        return $this->NomSalle;
    }

    public function setNomSalle(?Salles $NomSalle): static
    {
        $this->NomSalle = $NomSalle;

        return $this;
    }

    public function getPrenom(): ?Professeurs
    {
        return $this->Prenom;
    }

    public function setPrenom(?Professeurs $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getMatiere(): ?Matieres
    {
        return $this->Matiere;
    }

    public function setMatiere(?Matieres $Matiere): static
    {
        $this->Matiere = $Matiere;

        return $this;
    }
}
