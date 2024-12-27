<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AnneeScolaireRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: AnneeScolaireRepository::class)]
#[UniqueEntity(fields: ['Annee'], message: 'Cette année scolaire existe déjà')]
class AnneeScolaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 9)]
    private ?string $Annee = null;

    #[ORM\OneToMany(mappedBy: 'Annee', targetEntity: Inscription::class, orphanRemoval: true)]
    private Collection $inscriptions;

    #[ORM\OneToMany(mappedBy: 'AnneeScolaire', targetEntity: Emargement::class)]
    private Collection $emargements;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->emargements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?string
    {
        return $this->Annee;
    }

    public function setAnnee(string $Annee): static
    {
        $this->Annee = $Annee;

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
            $inscription->setAnnee($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getAnnee() === $this) {
                $inscription->setAnnee(null);
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
            $emargement->setAnneeScolaire($this);
        }

        return $this;
    }

    public function removeEmargement(Emargement $emargement): static
    {
        if ($this->emargements->removeElement($emargement)) {
            // set the owning side to null (unless already changed)
            if ($emargement->getAnneeScolaire() === $this) {
                $emargement->setAnneeScolaire(null);
            }
        }

        return $this;
    }
}
