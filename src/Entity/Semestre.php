<?php

namespace App\Entity;

use App\Repository\SemestreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SemestreRepository::class)]
class Semestre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Semestre = null;

    #[ORM\OneToMany(mappedBy: 'Semestre', targetEntity: Devoir::class, orphanRemoval: true)]
    private Collection $devoirs;

    #[ORM\OneToMany(mappedBy: 'Semestre', targetEntity: Composition::class, orphanRemoval: true)]
    private Collection $compositions;

    #[ORM\OneToMany(mappedBy: 'Semestre', targetEntity: Cours::class, orphanRemoval: true)]
    private Collection $cours;

    #[ORM\OneToMany(mappedBy: 'Semestre', targetEntity: Emargement::class)]
    private Collection $emargements;

    public function __construct()
    {
        $this->devoirs = new ArrayCollection();
        $this->compositions = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->emargements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSemestre(): ?string
    {
        return $this->Semestre;
    }

    public function setSemestre(string $Semestre): static
    {
        $this->Semestre = $Semestre;

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
            $devoir->setSemestre($this);
        }

        return $this;
    }

    public function removeDevoir(Devoir $devoir): static
    {
        if ($this->devoirs->removeElement($devoir)) {
            // set the owning side to null (unless already changed)
            if ($devoir->getSemestre() === $this) {
                $devoir->setSemestre(null);
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
            $composition->setSemestre($this);
        }

        return $this;
    }

    public function removeComposition(Composition $composition): static
    {
        if ($this->compositions->removeElement($composition)) {
            // set the owning side to null (unless already changed)
            if ($composition->getSemestre() === $this) {
                $composition->setSemestre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): static
    {
        if (!$this->cours->contains($cour)) {
            $this->cours->add($cour);
            $cour->setSemestre($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getSemestre() === $this) {
                $cour->setSemestre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Emargement>
     */
    public function getEmargements(): Collection
    {
        return $this->emargements;
    }

    public function addEmargement(Emargement $emargement): static
    {
        if (!$this->emargements->contains($emargement)) {
            $this->emargements->add($emargement);
            $emargement->setSemestre($this);
        }

        return $this;
    }

    public function removeEmargement(Emargement $emargement): static
    {
        if ($this->emargements->removeElement($emargement)) {
            // set the owning side to null (unless already changed)
            if ($emargement->getSemestre() === $this) {
                $emargement->setSemestre(null);
            }
        }

        return $this;
    }
}
