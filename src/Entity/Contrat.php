<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContratRepository::class)]
class Contrat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeContrat = null;

    #[ORM\OneToMany(mappedBy: 'Contrat', targetEntity: Professeurs::class, orphanRemoval: true)]
    private Collection $professeurs;

    public function __construct()
    {
        $this->professeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeContrat(): ?string
    {
        return $this->TypeContrat;
    }

    public function setTypeContrat(string $TypeContrat): static
    {
        $this->TypeContrat = $TypeContrat;

        return $this;
    }

    /**
     * @return Collection<int, Professeurs>
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(Professeurs $professeur): static
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs->add($professeur);
            $professeur->setContrat($this);
        }

        return $this;
    }

    public function removeProfesseur(Professeurs $professeur): static
    {
        if ($this->professeurs->removeElement($professeur)) {
            // set the owning side to null (unless already changed)
            if ($professeur->getContrat() === $this) {
                $professeur->setContrat(null);
            }
        }

        return $this;
    }
}
