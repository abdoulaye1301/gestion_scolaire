<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EmargementRepository;

#[ORM\Entity(repositoryClass: EmargementRepository::class)]
class Emargement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'emargements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classe $Classe = null;

    #[ORM\Column(length: 255)]
    private ?string $TitreCours = null;

    #[ORM\ManyToOne(inversedBy: 'emargements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Semestre $Semestre = null;

    #[ORM\ManyToOne(inversedBy: 'emargements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AnneeScolaire $AnneeScolaire = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $DateEmargement = null;

    #[ORM\ManyToOne(inversedBy: 'emargements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Professeurs $Professeurs = null;

    #[ORM\ManyToOne(inversedBy: 'emargements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matieres $Matieres = null;

    #[ORM\Column(length: 255)]
    private ?string $Duree = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $Debut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $Fin = null;

    public function __construct()
    {
        $this->DateEmargement = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClasse(): ?Classe
    {
        return $this->Classe;
    }

    public function setClasse(?Classe $Classe): static
    {
        $this->Classe = $Classe;

        return $this;
    }

    public function getTitreCours(): ?string
    {
        return $this->TitreCours;
    }

    public function setTitreCours(string $TitreCours): static
    {
        $this->TitreCours = $TitreCours;

        return $this;
    }

    public function getSemestre(): ?Semestre
    {
        return $this->Semestre;
    }

    public function setSemestre(?Semestre $Semestre): static
    {
        $this->Semestre = $Semestre;

        return $this;
    }

    public function getAnneeScolaire(): ?AnneeScolaire
    {
        return $this->AnneeScolaire;
    }

    public function setAnneeScolaire(?AnneeScolaire $AnneeScolaire): static
    {
        $this->AnneeScolaire = $AnneeScolaire;

        return $this;
    }

    public function getDateEmargement(): ?\DateTimeImmutable
    {
        return $this->DateEmargement;
    }

    public function setDateEmargement(\DateTimeImmutable $DateEmargement): static
    {
        $this->DateEmargement = $DateEmargement;

        return $this;
    }

    public function getProfesseurs(): ?Professeurs
    {
        return $this->Professeurs;
    }

    public function setProfesseurs(?Professeurs $Professeurs): static
    {
        $this->Professeurs = $Professeurs;

        return $this;
    }

    public function getMatieres(): ?Matieres
    {
        return $this->Matieres;
    }

    public function setMatieres(?Matieres $Matieres): static
    {
        $this->Matieres = $Matieres;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->Duree;
    }

    public function setDuree(string $Duree): static
    {
        $this->Duree = $Duree;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->Debut;
    }

    public function setDebut(\DateTimeInterface $Debut): static
    {
        $this->Debut = $Debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->Fin;
    }

    public function setFin(\DateTimeInterface $Fin): static
    {
        $this->Fin = $Fin;

        return $this;
    }
}
