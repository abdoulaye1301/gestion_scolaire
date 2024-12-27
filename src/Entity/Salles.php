<?php

namespace App\Entity;

use App\Repository\SallesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SallesRepository::class)]
class Salles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $NomSalle = null;

    #[ORM\Column]
    private ?int $CapaciteAccueil = null;

    #[ORM\Column(length: 100)]
    private ?string $Emplacement = null;

    #[ORM\ManyToOne(inversedBy: 'salles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classe $NomClasse = null;

    #[ORM\OneToMany(mappedBy: 'NomSalle', targetEntity: EmploiTemps::class, orphanRemoval: true)]
    private Collection $emploiTemps;

    public function __construct()
    {
        $this->emploiTemps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSalle(): ?string
    {
        return $this->NomSalle;
    }

    public function setNomSalle(string $NomSalle): static
    {
        $this->NomSalle = $NomSalle;

        return $this;
    }

    public function getCapaciteAccueil(): ?int
    {
        return $this->CapaciteAccueil;
    }

    public function setCapaciteAccueil(int $CapaciteAccueil): static
    {
        $this->CapaciteAccueil = $CapaciteAccueil;

        return $this;
    }

    public function getEmplacement(): ?string
    {
        return $this->Emplacement;
    }

    public function setEmplacement(string $Emplacement): static
    {
        $this->Emplacement = $Emplacement;

        return $this;
    }

    public function getNomClasse(): ?Classe
    {
        return $this->NomClasse;
    }

    public function setNomClasse(?Classe $NomClasse): static
    {
        $this->NomClasse = $NomClasse;

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
            $emploiTemp->setNomSalle($this);
        }

        return $this;
    }

    public function removeEmploiTemp(EmploiTemps $emploiTemp): static
    {
        if ($this->emploiTemps->removeElement($emploiTemp)) {
            // set the owning side to null (unless already changed)
            if ($emploiTemp->getNomSalle() === $this) {
                $emploiTemp->setNomSalle(null);
            }
        }

        return $this;
    }
}
