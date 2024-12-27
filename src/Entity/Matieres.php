<?php

namespace App\Entity;

use App\Repository\MatieresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatieresRepository::class)]
class Matieres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Matiere = null;

    #[ORM\Column]
    private ?int $CoefMatiere = null;

    #[ORM\OneToMany(mappedBy: 'Matiere', targetEntity: Devoir::class, orphanRemoval: true)]
    private Collection $devoirs;

    #[ORM\OneToMany(mappedBy: 'Matiere', targetEntity: Composition::class, orphanRemoval: true)]
    private Collection $compositions;

    #[ORM\OneToMany(mappedBy: 'Matiere', targetEntity: EmploiTemps::class, orphanRemoval: true)]
    private Collection $emploiTemps;

    #[ORM\OneToMany(mappedBy: 'Matiere', targetEntity: Cours::class, orphanRemoval: true)]
    private Collection $cours;

    #[ORM\OneToMany(mappedBy: 'Matieres', targetEntity: Emargement::class)]
    private Collection $emargements;

    public function __construct()
    {
        $this->devoirs = new ArrayCollection();
        $this->compositions = new ArrayCollection();
        $this->emploiTemps = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->emargements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatiere(): ?string
    {
        return $this->Matiere;
    }

    public function setMatiere(string $Matiere): static
    {
        $this->Matiere = $Matiere;

        return $this;
    }

    public function getCoefMatiere(): ?int
    {
        return $this->CoefMatiere;
    }

    public function setCoefMatiere(int $CoefMatiere): static
    {
        $this->CoefMatiere = $CoefMatiere;

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
            $devoir->setMatiere($this);
        }

        return $this;
    }

    public function removeDevoir(Devoir $devoir): static
    {
        if ($this->devoirs->removeElement($devoir)) {
            // set the owning side to null (unless already changed)
            if ($devoir->getMatiere() === $this) {
                $devoir->setMatiere(null);
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
            $composition->setMatiere($this);
        }

        return $this;
    }

    public function removeComposition(Composition $composition): static
    {
        if ($this->compositions->removeElement($composition)) {
            // set the owning side to null (unless already changed)
            if ($composition->getMatiere() === $this) {
                $composition->setMatiere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EmploiTemps>
     */
    public function getEmploiTemps(): Collection
    {
        return $this->emploiTemps;
    }

    public function addEmploiTemp(EmploiTemps $emploiTemp): static
    {
        if (!$this->emploiTemps->contains($emploiTemp)) {
            $this->emploiTemps->add($emploiTemp);
            $emploiTemp->setMatiere($this);
        }

        return $this;
    }

    public function removeEmploiTemp(EmploiTemps $emploiTemp): static
    {
        if ($this->emploiTemps->removeElement($emploiTemp)) {
            // set the owning side to null (unless already changed)
            if ($emploiTemp->getMatiere() === $this) {
                $emploiTemp->setMatiere(null);
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
            $cour->setMatiere($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getMatiere() === $this) {
                $cour->setMatiere(null);
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
            $emargement->setMatieres($this);
        }

        return $this;
    }

    public function removeEmargement(Emargement $emargement): static
    {
        if ($this->emargements->removeElement($emargement)) {
            // set the owning side to null (unless already changed)
            if ($emargement->getMatieres() === $this) {
                $emargement->setMatieres(null);
            }
        }

        return $this;
    }
}
