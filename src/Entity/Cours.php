<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classe $Classe = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matieres $Matiere = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $DebutCours = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $FinCours = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateCours = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Professeurs $Enseignant = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Semestre $Semestre = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeCours $TypeCours = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EtatCours $Etat = null;

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

    public function getMatiere(): ?Matieres
    {
        return $this->Matiere;
    }

    public function setMatiere(?Matieres $Matiere): static
    {
        $this->Matiere = $Matiere;

        return $this;
    }

    public function getDebutCours(): ?\DateTimeInterface
    {
        return $this->DebutCours;
    }

    public function setDebutCours(\DateTimeInterface $DebutCours): static
    {
        $this->DebutCours = $DebutCours;

        return $this;
    }

    public function getFinCours(): ?\DateTimeInterface
    {
        return $this->FinCours;
    }

    public function setFinCours(\DateTimeInterface $FinCours): static
    {
        $this->FinCours = $FinCours;

        return $this;
    }

    public function getDateCours(): ?\DateTimeInterface
    {
        return $this->DateCours;
    }

    public function setDateCours(\DateTimeInterface $DateCours): static
    {
        $this->DateCours = $DateCours;

        return $this;
    }

    public function getEnseignant(): ?Professeurs
    {
        return $this->Enseignant;
    }

    public function setEnseignant(?Professeurs $Enseignant): static
    {
        $this->Enseignant = $Enseignant;

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

    public function getTypeCours(): ?TypeCours
    {
        return $this->TypeCours;
    }

    public function setTypeCours(?TypeCours $TypeCours): static
    {
        $this->TypeCours = $TypeCours;

        return $this;
    }

    public function getEtat(): ?EtatCours
    {
        return $this->Etat;
    }

    public function setEtat(?EtatCours $Etat): static
    {
        $this->Etat = $Etat;

        return $this;
    }
}
