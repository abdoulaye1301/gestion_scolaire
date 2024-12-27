<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvaluationRepository::class)]
class Evaluation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomEvaluation = null;

    #[ORM\OneToMany(mappedBy: 'numeroDevoir', targetEntity: Devoir::class, orphanRemoval: true)]
    private Collection $devoirs;

    #[ORM\OneToMany(mappedBy: 'Evaluation', targetEntity: Composition::class, orphanRemoval: true)]
    private Collection $compositions;

    public function __construct()
    {
        $this->devoirs = new ArrayCollection();
        $this->compositions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEvaluation(): ?string
    {
        return $this->NomEvaluation;
    }

    public function setNomEvaluation(string $NomEvaluation): static
    {
        $this->NomEvaluation = $NomEvaluation;

        return $this;
    }

    /**
     * @return Collection<int, Devoir>
     */
    public function getDevoirs(): Collection
    {
        return $this->devoirs;
    }

    public function addDevoir(Devoir $devoir): static
    {
        if (!$this->devoirs->contains($devoir)) {
            $this->devoirs->add($devoir);
            $devoir->setNomEvaluation($this);
        }

        return $this;
    }

    public function removeDevoir(Devoir $devoir): static
    {
        if ($this->devoirs->removeElement($devoir)) {
            // set the owning side to null (unless already changed)
            if ($devoir->getNomEvaluation() === $this) {
                $devoir->setNomEvaluation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Composition>
     */
    public function getCompositions(): Collection
    {
        return $this->compositions;
    }

    public function addComposition(Composition $composition): static
    {
        if (!$this->compositions->contains($composition)) {
            $this->compositions->add($composition);
            $composition->setNomEvaluation($this);
        }

        return $this;
    }

    public function removeComposition(Composition $composition): static
    {
        if ($this->compositions->removeElement($composition)) {
            // set the owning side to null (unless already changed)
            if ($composition->getNomEvaluation() === $this) {
                $composition->setNomEvaluation(null);
            }
        }

        return $this;
    }
}
