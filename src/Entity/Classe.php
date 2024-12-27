<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomClasse = null;

    #[ORM\OneToMany(mappedBy: 'NomClasse', targetEntity: Inscription::class, orphanRemoval: true)]
    private Collection $inscriptions;

    #[ORM\Column]
    private ?int $CapaciteAccueil = null;

    #[ORM\Column]
    private ?float $MontantIsncription = null;

    #[ORM\OneToMany(mappedBy: 'NomClasse', targetEntity: Salles::class, orphanRemoval: true)]
    private Collection $salles;

    #[ORM\OneToMany(mappedBy: 'Classe', targetEntity: Cours::class, orphanRemoval: true)]
    private Collection $cours;

    #[ORM\OneToMany(mappedBy: 'Classe', targetEntity: Emargement::class)]
    private Collection $emargements;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->salles = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->emargements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClasse(): ?string
    {
        return $this->NomClasse;
    }

    public function setNomClasse(string $NomClasse): static
    {
        $this->NomClasse = $NomClasse;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setNomClasse($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getNomClasse() === $this) {
                $inscription->setNomClasse(null);
            }
        }

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

    public function getMontantIsncription(): ?float
    {
        return $this->MontantIsncription;
    }

    public function setMontantIsncription(float $MontantIsncription): static
    {
        $this->MontantIsncription = $MontantIsncription;

        return $this;
    }

    /**
     * @return Collection<int, Salles>
     */
    public function getSalles(): Collection
    {
        return $this->salles;
    }

    public function addSalle(Salles $salle): static
    {
        if (!$this->salles->contains($salle)) {
            $this->salles->add($salle);
            $salle->setNomClasse($this);
        }

        return $this;
    }

    public function removeSalle(Salles $salle): static
    {
        if ($this->salles->removeElement($salle)) {
            // set the owning side to null (unless already changed)
            if ($salle->getNomClasse() === $this) {
                $salle->setNomClasse(null);
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
            $cour->setClasse($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getClasse() === $this) {
                $cour->setClasse(null);
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
            $emargement->setClasse($this);
        }

        return $this;
    }

    public function removeEmargement(Emargement $emargement): static
    {
        if ($this->emargements->removeElement($emargement)) {
            // set the owning side to null (unless already changed)
            if ($emargement->getClasse() === $this) {
                $emargement->setClasse(null);
            }
        }

        return $this;
    }
}
