<?php

namespace App\Entity;

use App\Repository\CompositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompositionRepository::class)]
class Composition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Note = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateComposition = null;

    #[ORM\ManyToOne(inversedBy: 'compositions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Evaluation $NomEvaluation = null;

    #[ORM\ManyToOne(inversedBy: 'compositions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matieres $Matiere = null;

    #[ORM\ManyToOne(inversedBy: 'compositions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Semestre $Semestre = null;

    #[ORM\ManyToOne(inversedBy: 'compositions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Eleves $email = null;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->Note;
    }

    public function setNote(int $Note): static
    {
        $this->Note = $Note;

        return $this;
    }

    public function getDateComposition(): ?\DateTimeInterface
    {
        return $this->DateComposition;
    }

    public function setDateComposition(\DateTimeInterface $DateComposition): static
    {
        $this->DateComposition = $DateComposition;

        return $this;
    }

    public function getNomEvaluation(): ?Evaluation
    {
        return $this->NomEvaluation;
    }

    public function setNomEvaluation(?Evaluation $NomEvaluation): static
    {
        $this->NomEvaluation = $NomEvaluation;

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

    public function getSemestre(): ?Semestre
    {
        return $this->Semestre;
    }

    public function setSemestre(?Semestre $Semestre): static
    {
        $this->Semestre = $Semestre;

        return $this;
    }

    public function getEmail(): ?Eleves
    {
        return $this->email;
    }

    public function setEmail(?Eleves $email): static
    {
        $this->email = $email;

        return $this;
    }
}
