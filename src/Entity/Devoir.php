<?php

namespace App\Entity;

use App\Repository\DevoirRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevoirRepository::class)]
class Devoir
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateDevoir = null;

    #[ORM\Column]
    private ?float $Note = null;

    #[ORM\ManyToOne(inversedBy: 'devoirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Evaluation $NomEvaluation = null;

    #[ORM\ManyToOne(inversedBy: 'devoirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Semestre $Semestre = null;

    #[ORM\ManyToOne(inversedBy: 'devoirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matieres $Matiere = null;

    #[ORM\ManyToOne(inversedBy: 'devoirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Eleves $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDevoir(): ?\DateTimeInterface
    {
        return $this->DateDevoir;
    }

    public function setDateDevoir(\DateTimeInterface $DateDevoir): static
    {
        $this->DateDevoir = $DateDevoir;

        return $this;
    }
    public function getNote(): ?float
    {
        return $this->Note;
    }

    public function setNote(float $Note): static
    {
        $this->Note = $Note;

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

    public function getSemestre(): ?Semestre
    {
        return $this->Semestre;
    }

    public function setSemestre(?Semestre $Semestre): static
    {
        $this->Semestre = $Semestre;

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
